<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guild_settings', function (Blueprint $table) {
            $table->id();
            $table->string('guild_id')->unique();

            // Welcome & Goodbye
            $table->boolean('welcome_enabled')->default(false);
            $table->string('welcome_channel_id')->nullable();
            $table->text('welcome_message')->nullable();
            $table->boolean('welcome_embed_enabled')->default(false);
            $table->string('welcome_embed_title')->nullable();
            $table->text('welcome_embed_description')->nullable();
            $table->string('welcome_embed_color')->nullable();
            $table->string('welcome_embed_image')->nullable();
            $table->string('welcome_embed_thumbnail')->nullable();
            $table->boolean('welcome_dm_enabled')->default(false);
            $table->text('welcome_dm_message')->nullable();

            $table->boolean('goodbye_enabled')->default(false);
            $table->string('goodbye_channel_id')->nullable();
            $table->text('goodbye_message')->nullable();
            $table->boolean('goodbye_embed_enabled')->default(false);
            $table->string('goodbye_embed_title')->nullable();
            $table->text('goodbye_embed_description')->nullable();
            $table->string('goodbye_embed_color')->nullable();

            // Auto Role
            $table->boolean('auto_role_enabled')->default(false);
            $table->string('auto_role_id')->nullable();

            // Levels
            $table->boolean('levels_enabled')->default(true);
            $table->integer('xp_rate')->default(1);
            $table->string('level_up_channel_id')->nullable();
            $table->text('level_up_message')->nullable();

            // Moderation
            $table->string('mod_log_channel_id')->nullable();
            $table->boolean('anti_spam_enabled')->default(false);
            $table->boolean('anti_link_enabled')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guild_settings');
    }
};
