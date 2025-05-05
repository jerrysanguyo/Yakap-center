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
        Schema::create('parents_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')
                ->constrained('child_infos')
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('contact_number')
                ->nullable();
            $table->string('fb_account')
                ->nullable();
            $table->date('birth_date');
            $table->string('birth_place')
                ->nullable();
            $table->foreignId('education_id')
                ->nullable()
                ->constrained('educations')
                ->nullOnDelete();
            $table->string('work')
                ->nullable();
            $table->string('work_place')
                ->nullable();
            $table->foreignId('type_id')
                ->nullable()
                ->constrained('parent_types')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents_infos');
    }
};
