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
        Schema::create('cameras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nvr_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string(column: 'ip');
            $table->boolean(column: 'reachable')->default(false);
            $table->string('location');
            $table->foreignId('customer_id')->nullable()->constrained()->cascadeOnDelete();
            $table->datetime('last_changed')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cameras');
    }
};
