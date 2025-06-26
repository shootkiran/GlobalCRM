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
        Schema::create('telegram_chats', function (Blueprint $table) {
          

             $table->id();

    $table->bigInteger('chat_id'); // foreign key to telegrams.chat_id or actual Telegram chat
    $table->text('message')->nullable(); // message text
    $table->bigInteger('message_id')->nullable();
    $table->json('payload')->nullable(); // full Telegram payload for debugging/logging
    $table->timestamp('message_date')->nullable();

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_chats');
    }
};
