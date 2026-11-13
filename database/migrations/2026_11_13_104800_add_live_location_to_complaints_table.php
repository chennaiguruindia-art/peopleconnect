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
        Schema::table('complaints', function (Blueprint $table) {
            $table->decimal('live_latitude', 10, 7)->nullable()->after('landmark');
            $table->decimal('live_longitude', 10, 7)->nullable()->after('live_latitude');
            $table->text('live_address')->nullable()->after('live_longitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn(['live_latitude', 'live_longitude', 'live_address']);
        });
    }
};
