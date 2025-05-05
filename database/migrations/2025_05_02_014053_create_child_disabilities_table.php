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
        Schema::create('child_disabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('child_infos')->cascadeOnDelete();
            $table->foreignId('disability_id')->nullable()->constrained('disabilities')->nullOnDelete();
            $table->string('pwd_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_disabilities');
    }
};
