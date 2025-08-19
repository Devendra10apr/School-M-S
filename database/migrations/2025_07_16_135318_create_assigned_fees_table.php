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
        Schema::create('assigned_fees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');

            $table->foreignId('fee_type_id')->constrained()->onDelete('cascade'); 

            $table->string('roll_no');

            $table->enum('status', ['unpaid', 'paid', 'partial'])->default('unpaid');
            $table->date('paid_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigned_fees');
    }
};
