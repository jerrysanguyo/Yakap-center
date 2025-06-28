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
        Schema::create('child_educational_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')
                    ->constrained('child_infos')
                    ->cascadeOnDelete();
            $table->foreignId('objective_id')
                    ->nullable()
                    ->constrained('objectives')
                    ->nullOnDelete();
            $table->foreignId('rating_id')
                    ->nullable()
                    ->constrained('ratings')
                    ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_educational_plans');
    }
};
