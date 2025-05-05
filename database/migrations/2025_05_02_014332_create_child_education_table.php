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
        Schema::create('child_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('child_infos')->cascadeOnDelete();
            $table->foreignId('education_id')->nullable()->constrained('educations')->cascadeOnDelete();
            $table->string('school')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_education');
    }
};
