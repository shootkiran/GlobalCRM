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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ledger_class_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->boolean('cash_bank')->default(false);
            $table->boolean('default_account')->default(false);
            $table->decimal('balance', 15, 2)->default(0);
            $table->string('code')->unique();
            $table->foreignId('parent_id')->nullable()->constrained('ledgers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
