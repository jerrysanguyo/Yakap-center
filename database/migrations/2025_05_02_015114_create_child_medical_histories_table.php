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
        Schema::create('child_medical_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')
                ->constrained('child_infos')
                ->cascadeOnDelete();
            $table->enum('check_up',['Oo','Hindi']);
            $table->foreignId('blood_type_id')
                ->nullable()
                ->constrained('blood_types')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_medical_histories');
    }
};
