<?php

namespace Tests\Feature;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\RevenueDivision;
use App\Models\Taluk;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ComplaintStatusWorkflowTest extends TestCase
{
    protected function getOrCreateTestComplaint(): Complaint
    {
        $complaint = Complaint::first();
        if ($complaint) {
            return $complaint;
        }

        $taluk = Taluk::first();
        $category = ComplaintCategory::first();

        return Complaint::create([
            'complaint_id' => 'VNK-TEST-0001',
            'citizen_name' => 'Test Citizen',
            'citizen_mobile' => '9842100001',
            'citizen_email' => 'citizen@test.com',
            'citizen_address' => 'Test Address',
            'district_id' => $taluk->district_id,
            'revenue_division_id' => $taluk->revenue_division_id,
            'taluk_id' => $taluk->id,
            'category_id' => $category->id,
            'subject' => 'Test Grievance for Automated Workflow Testing',
            'description' => 'Test Grievance description for verifying status updates and attachments.',
            'priority' => 'high',
            'status' => 'submitted',
            'referral_status' => 'not_referred',
            'is_public' => true,
        ]);
    }

    public function test_complaint_show_page_has_only_update_status_and_no_assign_or_refer_buttons(): void
    {
        $admin = User::where('email', 'admin@virudhunagar.org')->first();
        $this->actingAs($admin);

        $complaint = $this->getOrCreateTestComplaint();
        $this->assertNotNull($complaint);

        $response = $this->get('/admin/complaints/' . $complaint->id);
        $response->assertStatus(200);

        // Contains Update Status
        $response->assertSee('Update Status');
        $response->assertSee('Received your complaint');
        $response->assertSee('Assigned officer to your complaint');
        $response->assertSee('Processing');
        $response->assertSee('Completed');

        // Does NOT contain assign officer or refer department buttons or forms
        $response->assertDontSee('#assignStaffModal');
        $response->assertDontSee('#referModal');
        $response->assertDontSee('data-bs-target="#assignStaffModal"', false);
        $response->assertDontSee('data-bs-target="#referModal"', false);
    }

    public function test_updating_status_to_resolved_requires_proof_attachment(): void
    {
        $admin = User::where('email', 'admin@virudhunagar.org')->first();
        $this->actingAs($admin);

        $complaint = $this->getOrCreateTestComplaint();

        // Updating to resolved WITHOUT file should fail validation
        $response = $this->postJson("/admin/complaints/{$complaint->id}/status", [
            'status' => 'resolved',
            'remarks' => 'Inspection completed and work resolved.',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['resolution_photo']);
    }

    public function test_updating_status_to_resolved_succeeds_with_proof(): void
    {
        Storage::fake('public');

        $admin = User::where('email', 'admin@virudhunagar.org')->first();
        $this->actingAs($admin);

        $complaint = $this->getOrCreateTestComplaint();

        $file = UploadedFile::fake()->image('resolution_proof.jpg');

        $response = $this->postJson("/admin/complaints/{$complaint->id}/status", [
            'status' => 'resolved',
            'remarks' => 'Pipe replacement done and water pressure restored.',
            'resolution_photo' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $complaint->refresh();
        $this->assertEquals('resolved', $complaint->status);
        $this->assertNotNull($complaint->resolved_at);
        $this->assertEquals('Pipe replacement done and water pressure restored.', $complaint->resolution_remarks);

        // Check attachment created
        $this->assertDatabaseHas('complaint_attachments', [
            'complaint_id' => $complaint->id,
            'attachment_type' => 'evidence_resolution',
        ]);
    }

    public function test_updating_status_to_in_progress_does_not_require_proof(): void
    {
        $admin = User::where('email', 'admin@virudhunagar.org')->first();
        $this->actingAs($admin);

        $complaint = $this->getOrCreateTestComplaint();

        $response = $this->postJson("/admin/complaints/{$complaint->id}/status", [
            'status' => 'in_progress',
            'remarks' => 'Technicians deployed to the site for ground verification.',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $complaint->refresh();
        $this->assertEquals('in_progress', $complaint->status);
    }
}
