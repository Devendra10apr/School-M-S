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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('roll_number');
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_type_id')->constrained()->onDelete('cascade');

            $table->double('total_marks', 8, 2);
            $table->double('obtained_marks', 8, 2);
            $table->double('practical_marks', 8, 2)->nullable();
            $table->double('percentage', 5, 2);
            $table->string('grade')->nullable();
            $table->enum('status', ['pass', 'fail']);
            $table->string('remark')->nullable();

            $table->string('session')->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
