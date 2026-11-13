<?php

namespace Tests\Feature;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\RevenueDivision;
use App\Models\Taluk;
use App\Models\User;
use Tests\TestCase;

class PortalEndpointsTest extends TestCase
{
    public function test_public_pages_load_successfully(): void
    {
        $pages = [
            '/',
            '/about',
            '/submit-complaint',
            '/track-complaint',
            '/district-information',
            '/updates',
            '/contact',
            '/privacy-policy',
            '/terms-conditions',
        ];

        foreach ($pages as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
        }
    }

    public function test_language_switcher_persists_session(): void
    {
        $response = $this->get('/lang/en');
        $response->assertSessionHas('public_locale', 'en');

        $response = $this->get('/lang/ta');
        $response->assertSessionHas('public_locale', 'ta');
    }

    public function test_admin_and_public_locales_are_independent(): void
    {
        // 1. Set public locale to English
        $this->get('/lang/en');
        $this->assertEquals('en', session('public_locale'));

        // Admin locale should still be default or unaffected
        $this->assertNull(session('admin_locale'));

        // 2. Set admin locale to Tamil
        $this->get('/admin/lang/ta');
        $this->assertEquals('ta', session('admin_locale'));

        // Public locale must NOT have been changed by admin change
        $this->assertEquals('en', session('public_locale'));

        // 3. Requesting public page sets app locale to 'en'
        $this->withSession(['public_locale' => 'en', 'admin_locale' => 'ta'])
            ->get('/');
        $this->assertEquals('en', app()->getLocale());

        // 4. Requesting admin page sets app locale to 'ta'
        $this->withSession(['public_locale' => 'en', 'admin_locale' => 'ta'])
            ->get('/admin/login');
        $this->assertEquals('ta', app()->getLocale());
    }

    public function test_location_ajax_endpoints_return_data(): void
    {
        $divisionRes = $this->getJson('/locations/divisions');
        $divisionRes->assertStatus(200)->assertJson(['success' => true]);

        $division = RevenueDivision::first();
        if ($division) {
            $talukRes = $this->getJson('/locations/taluks?division_id=' . $division->id);
            $talukRes->assertStatus(200)->assertJson(['success' => true]);
        }

        $taluk = Taluk::first();
        if ($taluk) {
            $villageRes = $this->getJson('/locations/villages?taluk_id=' . $taluk->id);
            $villageRes->assertStatus(200)->assertJson(['success' => true]);
        }
    }

    public function test_gemini_translation_api_endpoint(): void
    {
        $response = $this->postJson('/api/translate', [
            'text' => 'வணக்கம்',
            'target' => 'en',
            'source' => 'ta',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_complaint_registration_and_tracking(): void
    {
        $division = RevenueDivision::first();
        $taluk = Taluk::where('revenue_division_id', $division->id)->first();
        $category = ComplaintCategory::first();

        $complaintData = [
            'citizen_name' => 'K. Mariyappan',
            'citizen_mobile' => '9842188888',
            'citizen_email' => 'mariyappan@gmail.com',
            'citizen_address' => '12, North Car Street, Virudhunagar',
            'district_id' => $division->district_id,
            'revenue_division_id' => $division->id,
            'taluk_id' => $taluk->id,
            'category_id' => $category->id,
            'subject' => 'Continuous drinking water leakage on North Car Street',
            'description' => 'The main drinking water distribution valve has been leaking heavily for three days. Potable water is going down the drain. Please inspect and repair urgently.',
            'priority' => 'high',
            'privacy_consent' => '1',
        ];

        $postRes = $this->postJson('/complaints', $complaintData);
        $postRes->assertStatus(200)->assertJson(['success' => true]);
        $complaintId = $postRes->json('complaint_id');
        $this->assertNotEmpty($complaintId);

        // Test Tracking Endpoint
        $trackRes = $this->postJson('/track-complaint', [
            'complaint_id' => $complaintId,
            'citizen_mobile' => '9842188888',
        ]);

        $trackRes->assertStatus(200)
            ->assertJson(['success' => true])
            ->assertJsonPath('data.complaint_id', $complaintId);
    }

    public function test_complaint_registration_with_custom_village_name(): void
    {
        $division = RevenueDivision::first();
        $taluk = Taluk::where('revenue_division_id', $division->id)->first();
        $category = ComplaintCategory::first();

        $complaintData = [
            'citizen_name' => 'S. Anand',
            'citizen_mobile' => '9842177777',
            'citizen_email' => 'anand@gmail.com',
            'citizen_address' => 'Plot 10, Bharathi Nagar',
            'district_id' => $division->district_id,
            'revenue_division_id' => $division->id,
            'taluk_id' => $taluk->id,
            'revenue_village_id' => 'other',
            'custom_village_name' => 'பாரதி நகர் காலனி (Bharathi Nagar Colony)',
            'category_id' => $category->id,
            'subject' => 'Water leakage near community hall',
            'description' => 'Clean water is leaking from the main pipe near community hall for 4 days.',
            'priority' => 'medium',
            'privacy_consent' => '1',
        ];

        $postRes = $this->postJson('/complaints', $complaintData);
        $postRes->assertStatus(200)->assertJson(['success' => true]);
        $complaintId = $postRes->json('complaint_id');
        $this->assertNotEmpty($complaintId);

        $complaint = Complaint::where('complaint_id', $complaintId)->first();
        $this->assertEquals('பாரதி நகர் காலனி (Bharathi Nagar Colony)', $complaint->village_name);
    }

    public function test_complaint_registration_with_live_gps_location_and_admin_only_visibility(): void
    {
        $division = RevenueDivision::first();
        $taluk = Taluk::where('revenue_division_id', $division->id)->first();
        $category = ComplaintCategory::first();

        $complaintData = [
            'citizen_name' => 'M. Veluchamy',
            'citizen_mobile' => '9842166666',
            'citizen_email' => 'velu@gmail.com',
            'citizen_address' => '3/45, South Street, Virudhunagar',
            'district_id' => $division->district_id,
            'revenue_division_id' => $division->id,
            'taluk_id' => $taluk->id,
            'live_latitude' => 9.5680123,
            'live_longitude' => 77.9624567,
            'live_address' => 'Near Collectorate, Virudhunagar, Tamil Nadu 626002',
            'category_id' => $category->id,
            'subject' => 'Street light faulty near main junction',
            'description' => 'The street light has not been operational for over a week, causing darkness at night.',
            'priority' => 'medium',
            'privacy_consent' => '1',
        ];

        $postRes = $this->postJson('/complaints', $complaintData);
        $postRes->assertStatus(200)->assertJson(['success' => true]);
        $complaintId = $postRes->json('complaint_id');
        $this->assertNotEmpty($complaintId);

        $complaint = Complaint::where('complaint_id', $complaintId)->first();
        $this->assertNotNull($complaint);
        $this->assertTrue($complaint->has_live_location);
        $this->assertEquals(9.5680123, (float)$complaint->live_latitude);
        $this->assertEquals(77.9624567, (float)$complaint->live_longitude);
        $this->assertEquals('Near Collectorate, Virudhunagar, Tamil Nadu 626002', $complaint->live_address);
        $this->assertStringContainsString('https://www.google.com/maps?q=9.5680123,77.9624567', $complaint->google_maps_url);

        // Verify public tracking DOES NOT expose live GPS location or address
        $trackRes = $this->postJson('/track-complaint', [
            'complaint_id' => $complaintId,
            'citizen_mobile' => '9842166666',
        ]);
        $trackRes->assertStatus(200);
        $this->assertArrayNotHasKey('live_latitude', $trackRes->json('data'));
        $this->assertArrayNotHasKey('live_longitude', $trackRes->json('data'));
        $this->assertArrayNotHasKey('live_address', $trackRes->json('data'));

        // Verify admin CAN view the live GPS location on admin show page
        $admin = User::where('email', 'admin@virudhunagar.org')->first();
        $adminShowRes = $this->actingAs($admin)->get(route('admin.complaints.show', $complaint->id));
        $adminShowRes->assertStatus(200);
        $adminShowRes->assertSee('Live GPS Location');
        $adminShowRes->assertSee('9.5680123');
        $adminShowRes->assertSee('Near Collectorate, Virudhunagar');
    }

    public function test_admin_authentication_and_dashboard_access(): void
    {
        $admin = User::where('email', 'admin@virudhunagar.org')->first();
        $this->assertNotNull($admin);

        // Dashboard without auth redirects to login
        $guestRes = $this->get('/admin/dashboard');
        $guestRes->assertRedirect(route('admin.login'));

        // Admin login
        $loginRes = $this->post('/admin/login', [
            'email' => 'admin@virudhunagar.org',
            'password' => 'password123',
        ]);
        $loginRes->assertRedirect(route('admin.dashboard'));

        // Authenticated dashboard
        $authRes = $this->actingAs($admin)->get('/admin/dashboard');
        $authRes->assertStatus(200);

        // Chart Data endpoint
        $chartRes = $this->actingAs($admin)->getJson('/admin/api/dashboard-charts');
        $chartRes->assertStatus(200)->assertJson(['success' => true]);

        // Complaints list
        $complaintsRes = $this->actingAs($admin)->get('/admin/complaints');
        $complaintsRes->assertStatus(200);

        // Complaint show view
        $firstComplaint = Complaint::first();
        if ($firstComplaint) {
            $showRes = $this->actingAs($admin)->get('/admin/complaints/' . $firstComplaint->id);
            $showRes->assertStatus(200);
        }

        // Location master
        $locRes = $this->actingAs($admin)->get('/admin/locations');
        $locRes->assertStatus(200);

        // Categories
        $catRes = $this->actingAs($admin)->get('/admin/categories');
        $catRes->assertStatus(200);

        // Staff
        $staffRes = $this->actingAs($admin)->get('/admin/staff');
        $staffRes->assertStatus(200);

        // Reports
        $repRes = $this->actingAs($admin)->get('/admin/reports');
        $repRes->assertStatus(200);

        // Updates
        $upRes = $this->actingAs($admin)->get('/admin/updates');
        $upRes->assertStatus(200);

        // Settings
        $setRes = $this->actingAs($admin)->get('/admin/settings');
        $setRes->assertStatus(200);
    }
}
