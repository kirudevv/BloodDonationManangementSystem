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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained('hospital', 'hospital_id');
            $table->foreignId('donation_id')->constrained('donation', 'donation_id')->onDelete('cascade')->nullable();
            $table->foreignId('request_id')->constrained('bloodrequests', 'request_id')->onDelete('cascade')->nullable();
            $table->enum('status', ['Scheduled', 'Completed', 'No-show', 'Cancelled']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
