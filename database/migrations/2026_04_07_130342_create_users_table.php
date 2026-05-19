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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+','O-']);
            $table->enum('role', ['admin', 'staff', 'hospital_staff', 'user'])->default('user');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->enum('gender', ['Male', 'Female']);
            $table->foreignId('hospital_id')->constrained('hospital', 'hospital_id')->onDelete('cascade');
            $table->date('date_of_birth');
            $table->string('contact_info');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE users AUTO_INCREMENT = 10001;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
