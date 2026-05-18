<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recommendation_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('source_course_id')
                  ->nullable()
                  ->constrained('courses')
                  ->nullOnDelete();
            $table->foreignId('recommended_course_id')
                  ->constrained('courses')
                  ->cascadeOnDelete();
            $table->float('similarity_score')->default(0);
            $table->boolean('was_clicked')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recommendation_logs');
    }
};
