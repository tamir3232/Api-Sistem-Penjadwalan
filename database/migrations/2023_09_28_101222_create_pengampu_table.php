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
        Schema::create('pengampu', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->uuid('dosen_id')->nullable();
            $table->uuid('matakuliah_id')->nullable();
            $table->uuid('kelas_id')->nullable();
            // $table->softDeletes();

            $table->foreign('dosen_id')
                ->references('id')
                ->on('dosens')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('matakuliah_id')
                ->references('id')
                ->on('matakuliah')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengampu');
    }
};
