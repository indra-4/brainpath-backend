<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Drop deprecated tables that are no longer used after the ML-first refactor.
 *   - chatbot_rules   → replaced by FastAPI LLM gateway
 *   - user_learning_paths → removed with the static learning-path feature
 *   - learning_paths       → removed with the static learning-path feature
 *
 * Order matters: child tables before parent tables to satisfy FK constraints.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('chatbot_rules');
        Schema::dropIfExists('user_learning_paths');
        Schema::dropIfExists('learning_paths');
    }

    public function down(): void
    {
        // Re-creating these tables is intentionally not supported.
        // Restore from a previous migration run if needed.
    }
};
