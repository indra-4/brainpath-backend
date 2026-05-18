<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * DEPRECATED — Learning paths feature has been removed.
 * Table is created here as a stub so the drop migration (000010) can still
 * reference and remove it cleanly. No FK back to users is added anymore.
 */
return new class extends Migration
{
    public function up(): void
    {
        // Create the table as a lightweight stub so the later drop migration works.
        Schema::create('learning_paths', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // ⛔ FK constraint on users.current_path_id intentionally REMOVED.
        // That column no longer exists after the users migration refactor.
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_paths');
    }
};
