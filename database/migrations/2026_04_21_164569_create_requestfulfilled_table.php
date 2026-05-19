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
        Schema::create('requestfulfilled', function (Blueprint $table) {
            $table->id('fulfillment_id');
            $table->foreignId('request_id')->constrained('bloodrequests', 'request_id')->onDelete('cascade');
            $table->foreignId('inventory_id')->constrained('inventory', 'inventory_id')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requestfulfilled');
    }
};
