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
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
           //FK KEYS
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->constrained('users')->onDelete('cascade');

          
            
            $table->string('student_email')->unique();
            $table->string('student_mobile')->nullable();
            $table->string('roll_no');

        
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('dob')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('tc_no')->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();

           
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
