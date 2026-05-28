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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('external_url')->nullable();
            $table->string('level')->nullable();
            $table->text('summary')->nullable();
            $table->json('learning_points')->nullable();
            // Optional: ubah tipe duration_minutes menjadi string jika frontend mengirim "45 menit" atau sebaliknya.
            // Biarkan saja duration_minutes, frontend akan mengirim string ke kolom baru 'duration_text' atau kita parse ke menit di controller.
            $table->string('duration_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
};
