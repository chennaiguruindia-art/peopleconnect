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
        Schema::dropIfExists('otp_verifications');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('otp_verifications')) {
            Schema::create('otp_verifications', function (Blueprint $table) {
                $table->id();
                $table->string('mobile')->index();
                $table->string('otp_code');
                $table->string('purpose')->default('complaint_submission');
                $table->timestamp('expires_at');
                $table->boolean('is_verified')->default(false);
                $table->integer('attempts')->default(0);
                $table->timestamps();
            });
        }
    }
};
