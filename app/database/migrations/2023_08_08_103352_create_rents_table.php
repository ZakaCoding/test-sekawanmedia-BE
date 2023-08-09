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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('user_id'); // get supervisor id
            $table->unsignedBigInteger('driver_id');
            
            // costume table here
            $table->string('initial_miles')->nullable();
            $table->string('final_miles')->nullable();
            $table->string('fuel')->nullable();
            $table->enum('status', ['approved', 'pending', 'reject', 'done'])->default('pending');

            // foreign key
            $table->foreign('vehicle_id')->on('vehicles')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('driver_id')->on('drivers')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
