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
        Schema::create('maintenance_log', function (Blueprint $table) {
            $table->foreignId('plant_user_id')->constrained('plant_user'); // Explicit table name
            $table->foreignId('maintenance_id')->constrained();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            // Add composite primary key
            $table->primary(['plant_user_id', 'maintenance_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_log');
    }
};