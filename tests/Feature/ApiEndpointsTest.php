<?php

namespace Tests\Feature;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\District;
use App\Models\Role;
use App\Models\Taluk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiEndpointsTest extends TestCase
{
    /**
     * Test public meta endpoints.
     */
    public function test_public_meta_endpoints(): void
    {
        $resSettings = $this->getJson('/api/v1/meta/settings');
        $resSettings->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.contact_email', 'thepeopleconnectofficial@gmail.com')
            ->assertJsonPath('data.instagram_handle', '@thepeopleconnectofficial');

        $resDistricts = $this->getJson('/api/v1/meta/districts');
        $resDistricts->assertStatus(200)
            ->assertJsonPath('success', true);

        $resCategories = $this->getJson('/api/v1/meta/categories');
        $resCategories->assertStatus(200)
            ->assertJsonPath('success', true);

        $resEmergency = $this->getJson('/api/v1/meta/emergency-directory');
        $resEmergency->assertStatus(200)
            ->assertJsonPath('success', true);
    }

    /**
     * Test citizen OTP flow.
     */
    public function test_citizen_otp_request_and_verify(): void
    {
        $resReq = $this->postJson('/api/v1/citizen/auth/request-otp', [
            'mobile' => '9876543210',
        ]);

        $resReq->assertStatus(200)
            ->assertJsonPath('success', true);

        $resVerify = $this->postJson('/api/v1/citizen/auth/verify-otp', [
            'mobile' => '9876543210',
            'otp' => '123456',
            'name' => 'Test Citizen',
        ]);

        $resVerify->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'token_type',
                    'user' => ['id', 'name', 'mobile', 'email', 'role'],
                ],
            ]);

        $token = $resVerify->json('data.token');

        // Test authenticated profile
        $resProfile = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/v1/citizen/auth/profile');

        $resProfile->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.user.mobile', '9876543210');
    }

    /**
     * Test admin login and protected endpoints.
     */
    public function test_admin_api_login_and_protected_access(): void
    {
        // 1. Unauthorized request without token
        $this->getJson('/api/v1/admin/dashboard/stats')->assertStatus(401);

        // 2. Perform Admin login
        $adminLogin = $this->postJson('/api/v1/admin/auth/login', [
            'email' => 'thepeopleconnectofficial@gmail.com',
            'password' => 'password123',
        ]);

        $adminLogin->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'token_type',
                    'admin' => ['id', 'name', 'email', 'role'],
                ],
            ]);

        $adminToken = $adminLogin->json('data.token');

        // 3. Authorized access with Bearer token
        $statsRes = $this->withHeader('Authorization', 'Bearer ' . $adminToken)
            ->getJson('/api/v1/admin/dashboard/stats');

        $statsRes->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'data' => ['total', 'submitted', 'in_progress', 'resolved'],
            ]);

        // 4. Admin complaints list
        $complaintsRes = $this->withHeader('Authorization', 'Bearer ' . $adminToken)
            ->getJson('/api/v1/admin/complaints');

        $complaintsRes->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'data',
                'pagination' => ['current_page', 'total'],
            ]);
    }

    /**
     * Test citizen complaint submission and tracking via API.
     */
    public function test_citizen_complaint_submission_and_tracking(): void
    {
        $district = District::first();
        $taluk = Taluk::first();
        $category = ComplaintCategory::first();

        // 1. Submit complaint
        $submitRes = $this->postJson('/api/v1/citizen/complaints', [
            'citizen_name' => 'Karthik Raja',
            'citizen_mobile' => '9842199999',
            'citizen_email' => 'karthik@example.com',
            'citizen_address' => '12, Gandhi Nagar, Virudhunagar',
            'district_id' => $district->id,
            'taluk_id' => $taluk->id,
            'category_id' => $category->id,
            'subject' => 'Street Light Repair Needed',
            'description' => 'Street light not working for the past 3 days in Gandhi Nagar.',
            'priority' => 'high',
        ]);

        $submitRes->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'data' => ['complaint_id', 'status', 'citizen_name'],
            ]);

        $complaintId = $submitRes->json('data.complaint_id');

        // 2. Track complaint
        $trackRes = $this->postJson('/api/v1/citizen/complaints/track', [
            'complaint_id' => $complaintId,
            'citizen_mobile' => '9842199999',
        ]);

        $trackRes->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.complaint_id', $complaintId)
            ->assertJsonPath('data.status', 'submitted');
    }
}
