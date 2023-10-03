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
        Schema::create('diagnostic_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('malfunction_id');
            $table->unsignedBigInteger('symptom_id');
    
            $table->foreign('malfunction_id')
                ->references('id')
                ->on('malfunctions')
                ->onDelete('cascade'); // Cascade delete when related Malfunction is deleted
    
            $table->foreign('symptom_id')
                ->references('id')
                ->on('symptoms')
                ->onDelete('cascade'); // Cascade delete when related Symptom is deleted
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_rules');
    }
};
