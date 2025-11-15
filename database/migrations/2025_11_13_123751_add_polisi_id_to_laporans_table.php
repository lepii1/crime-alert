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
        Schema::table('laporans', function (Blueprint $table) {
            $table->unsignedBigInteger('polisi_id')->nullable()->after('user_id');

            $table->foreign('polisi_id')
                ->references('id')
                ->on('polisis')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropForeign('polisi_id');
            $table->dropColumn('polisi_id');
        });
    }
};
