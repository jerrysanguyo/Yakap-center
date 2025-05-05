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
        Schema::create('child_emergencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')
                ->constrained('child_infos')
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('contact_number');
            $table->foreignId('relationship_id')
                ->nullable()
                ->constrained('relations')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_emergencies');
    }
};
