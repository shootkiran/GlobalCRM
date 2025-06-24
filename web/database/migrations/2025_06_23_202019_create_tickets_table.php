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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->text('description');
            $table->foreignId('support_category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('support_team_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('created_by');
            $table->foreignId('started_by')->nullable();
            $table->foreignId('completed_by')->nullable();
            $table->foreignId('closed_by')->nullable();
            $table->datetime('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->datetime('closed_at')->nullable();
            $table->string('priority')->default('normal');
            $table->string('status')->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
