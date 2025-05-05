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
        Schema::create('child_families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('full_name');
            $table->date('birth_date')
                ->nullable();
            $table->foreignId('gender_id')
                ->nullable()
                ->constrained('genders')
                ->nullOndelete();
            $table->foreignId('relationship_id')
                ->nullable()
                ->constrained('relationships')
                ->nullOndelete();
            $table->foreignId('civil_id')
                ->nullable()
                ->constrained('civil_statuses')
                ->nullOndelete();
            $table->foreignId('education_id')
                ->nullable()
                ->constrained('educations')
                ->nullOndelete();
            $table->string('work')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_families');
    }
};
