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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
           // $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('aadhaar_no')->unique()->nullable();
            $table->string('education')->nullable();
            $table->string('subject')->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
