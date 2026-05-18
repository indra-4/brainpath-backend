<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('category')->index(); // Replaces learning_path grouping
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('tags')->nullable(); // JSONB on Postgres via json() type
            $table->integer('order_index')->default(0);
            $table->integer('duration_minutes')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
