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
        Schema::table('polisis', function (Blueprint $table) {
            if (!Schema::hasColumn('polisis', 'jabatan')) {
                $table->string('jabatan')->nullable();
            }

            if (!Schema::hasColumn('polisis', 'no_hp')) {
                $table->string('no_hp')->nullable();
            }

            if (!Schema::hasColumn('polisis', 'avatar')) {
                $table->string('avatar')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('polisis', function (Blueprint $table) {
            $table->dropColumn(['jabatan', 'no_hp', 'avatar']);
        });
    }
};
