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
        Schema::create('application_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('child_infos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status',['submitted enrollment form', 'submitted requirements', 'interview', 'non-appearance', 'enrolled', 'rejected', 'graduate']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_statuses');
    }
};