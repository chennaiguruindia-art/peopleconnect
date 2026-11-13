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
        Schema::table('public_updates', function (Blueprint $table) {
            if (!Schema::hasColumn('public_updates', 'source_name')) {
                $table->string('source_name')->nullable()->after('category');
            }
            if (!Schema::hasColumn('public_updates', 'source_url')) {
                $table->text('source_url')->nullable()->after('source_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public_updates', function (Blueprint $table) {
            if (Schema::hasColumn('public_updates', 'source_url')) {
                $table->dropColumn('source_url');
            }
            if (Schema::hasColumn('public_updates', 'source_name')) {
                $table->dropColumn('source_name');
            }
        });
    }
};
