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
        Schema::table('contraint', function (Blueprint $table) {
            $table->dropForeign(['pengampu_id']);
            $table->dropColumn('pengampu_id');

            $table->uuid('dosen_id')->nullable();

            $table->foreign('dosen_id')
                ->references('id')
                ->on('dosens')
                ->onUpdate('cascade')
                ->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contraint', function (Blueprint $table) {
            $table->dropColumn('dosen_id')->nullable();
        });
    }
};
