<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contraint', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pengampu_id')->nullable();
            $table->uuid('hari_id')->nullable();
            $table->uuid('jam_id')->nullable();
            $table->softDeletes();

              $table->foreign('pengampu_id')
                    -> references('id')
                    -> on('pengampu')
                    -> onUpdate('cascade')
                    -> onDelete('cascade');

              $table-> foreign('hari_id')
                    -> references('id')
                    -> on('hari')
                    -> onUpdate('cascade')
                    -> onDelete('cascade');

              $table-> foreign('jam_id')
                    -> references('id')
                    -> on('jam')
                    -> onUpdate('cascade')
                    -> onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contraint');
    }
};
