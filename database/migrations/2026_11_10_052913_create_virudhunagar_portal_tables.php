<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->string('display_name_ta')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 2. Permissions table
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Role permissions pivot
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
            $table->timestamps();
        });

        // Modify or enhance users table with role and mobile
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained('roles')->nullOnDelete();
            $table->string('mobile')->nullable()->after('email');
            $table->string('designation')->nullable()->after('mobile');
            $table->string('department')->nullable()->after('designation');
            $table->boolean('is_active')->default(true)->after('password');
        });

        // 3. Admins table (supporting dedicated admin credentials/records)
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        // 4. Districts
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name_en');
            $table->string('name_ta');
            $table->string('state')->default('குரலற்ற மகளின் குரல்');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. Revenue Divisions
        Schema::create('revenue_divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('name_en');
            $table->string('name_ta');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 6. Taluks (Revenue Taluks)
        Schema::create('taluks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('revenue_division_id')->constrained('revenue_divisions')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('name_en');
            $table->string('name_ta');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 7. Revenue Villages
        Schema::create('revenue_villages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taluk_id')->constrained('taluks')->onDelete('cascade');
            $table->string('code')->nullable();
            $table->string('name_en');
            $table->string('name_ta');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 8. Development Blocks (Panchayat Unions)
        Schema::create('development_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('name_en');
            $table->string('name_ta');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 9. Village Panchayats
        Schema::create('village_panchayats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('development_block_id')->constrained('development_blocks')->onDelete('cascade');
            $table->string('code')->nullable();
            $table->string('name_en');
            $table->string('name_ta');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 10. Habitations
        Schema::create('habitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_panchayat_id')->constrained('village_panchayats')->onDelete('cascade');
            $table->string('code')->nullable();
            $table->string('name_en');
            $table->string('name_ta');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 11. Municipalities / Corporations
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('name_en');
            $table->string('name_ta');
            $table->enum('type', ['Corporation', 'Special Grade', 'Selection Grade', 'First Grade', 'Second Grade'])->default('First Grade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 12. Town Panchayats
        Schema::create('town_panchayats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('name_en');
            $table->string('name_ta');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 13. Wards
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('municipality_id')->nullable()->constrained('municipalities')->onDelete('cascade');
            $table->foreignId('town_panchayat_id')->nullable()->constrained('town_panchayats')->onDelete('cascade');
            $table->string('ward_number');
            $table->string('name_en')->nullable();
            $table->string('name_ta')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 14. Complaint Categories
        Schema::create('complaint_categories', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name_en');
            $table->string('name_ta');
            $table->text('description_en')->nullable();
            $table->text('description_ta')->nullable();
            $table->string('icon')->default('bi-exclamation-triangle');
            $table->string('department_name_en');
            $table->string('department_name_ta');
            $table->integer('sla_days')->default(7);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 15. Complaints table
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('complaint_id')->unique()->index();
            $table->string('citizen_name');
            $table->string('citizen_mobile')->index();
            $table->string('citizen_email')->nullable();
            $table->text('citizen_address');
            
            // Location relations
            $table->foreignId('district_id')->constrained('districts')->onDelete('restrict');
            $table->foreignId('revenue_division_id')->constrained('revenue_divisions')->onDelete('restrict');
            $table->foreignId('taluk_id')->constrained('taluks')->onDelete('restrict');
            $table->foreignId('revenue_village_id')->nullable()->constrained('revenue_villages')->nullOnDelete();
            $table->string('ward_number')->nullable();
            $table->string('landmark')->nullable();

            // Grievance details
            $table->foreignId('category_id')->constrained('complaint_categories')->onDelete('restrict');
            $table->string('subject');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            
            // Status workflow
            $table->enum('status', [
                'submitted',
                'under_review',
                'awaiting_information',
                'assigned',
                'referred',
                'in_progress',
                'resolved',
                'closed',
                'rejected'
            ])->default('submitted')->index();

            // Referral status
            $table->enum('referral_status', [
                'not_referred',
                'referred_to_department',
                'acknowledged_by_department',
                'report_received',
                'action_taken'
            ])->default('not_referred');

            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_otp_verified')->default(false);
            $table->timestamp('otp_verified_at')->nullable();
            $table->boolean('privacy_consent')->default(true);
            $table->boolean('is_public')->default(false);
            $table->text('resolution_remarks')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });

        // 16. Complaint Attachments
        Schema::create('complaint_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained('complaints')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->enum('attachment_type', ['photo', 'document', 'evidence_resolution'])->default('photo');
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 17. Complaint History (Audit trail of all status updates)
        Schema::create('complaint_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained('complaints')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');
            $table->string('previous_status')->nullable();
            $table->string('new_status');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        // 18. Complaint Assignments
        Schema::create('complaint_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained('complaints')->onDelete('cascade');
            $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
            $table->text('instructions')->nullable();
            $table->enum('status', ['pending', 'accepted', 'in_progress', 'completed'])->default('pending');
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // 19. Department Referrals
        Schema::create('department_referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained('complaints')->onDelete('cascade');
            $table->string('department_name');
            $table->string('officer_name')->nullable();
            $table->string('officer_contact')->nullable();
            $table->string('referral_letter_no')->nullable();
            $table->date('referral_date');
            $table->enum('acknowledgement_status', ['pending', 'acknowledged', 'inspection_scheduled', 'action_taken', 'report_submitted'])->default('pending');
            $table->text('remarks')->nullable();
            $table->date('response_date')->nullable();
            $table->text('resolution_details')->nullable();
            $table->foreignId('referred_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 20. Notifications
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('mobile')->nullable();
            $table->string('title');
            $table->text('message');
            $table->string('type')->default('sms'); // sms, system, email
            $table->boolean('is_read')->default(false);
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps();
        });

        // 21. Citizen Feedback
        Schema::create('citizen_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained('complaints')->onDelete('cascade');
            $table->tinyInteger('rating')->default(5); // 1 to 5
            $table->text('comments')->nullable();
            $table->boolean('is_satisfied')->default(true);
            $table->timestamps();
        });

        // 22. Public Updates
        Schema::create('public_updates', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ta');
            $table->text('content_en');
            $table->text('content_ta');
            $table->string('category')->default('General');
            $table->string('featured_image')->nullable();
            $table->timestamp('published_at')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 23. Activity Logs
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
        });

        // 24. OTP Verifications
        Schema::create('otp_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('mobile')->index();
            $table->string('otp_code');
            $table->string('purpose')->default('complaint_submission'); // complaint_submission, complaint_tracking
            $table->timestamp('expires_at');
            $table->boolean('is_verified')->default(false);
            $table->integer('attempts')->default(0);
            $table->timestamps();
        });

        // 25. System Settings
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('otp_verifications');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('public_updates');
        Schema::dropIfExists('citizen_feedback');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('department_referrals');
        Schema::dropIfExists('complaint_assignments');
        Schema::dropIfExists('complaint_history');
        Schema::dropIfExists('complaint_attachments');
        Schema::dropIfExists('complaints');
        Schema::dropIfExists('complaint_categories');
        Schema::dropIfExists('wards');
        Schema::dropIfExists('town_panchayats');
        Schema::dropIfExists('municipalities');
        Schema::dropIfExists('habitations');
        Schema::dropIfExists('village_panchayats');
        Schema::dropIfExists('development_blocks');
        Schema::dropIfExists('revenue_villages');
        Schema::dropIfExists('taluks');
        Schema::dropIfExists('revenue_divisions');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('admins');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'mobile', 'designation', 'department', 'is_active']);
        });

        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
