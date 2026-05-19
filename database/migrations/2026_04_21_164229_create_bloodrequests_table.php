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
        Schema::create('bloodrequests', function (Blueprint $table) {
            $table->id('request_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained('hospital', 'hospital_id')->onDelete('cascade');
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+','O-']);
            $table->enum('gender', ['Male', 'Female']);
            $table->enum('blood_components', ['Whole Blood', 'Platelets', 'Plasma']);
            $table->integer('units');
            $table->integer('quantity');
            $table->enum('urgency', ['Normal', 'Urgent', 'Emergency']);
            $table->text('attending_physician');
            $table->text('address');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloodrequests');
    }
};
