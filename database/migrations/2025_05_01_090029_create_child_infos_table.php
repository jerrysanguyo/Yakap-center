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
        Schema::create('child_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_number');
            $table->foreignId('parents_id')->constrained('users')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('midle_name')->nullable();   
            $table->string('last_name');
            $table->foreignId('gender_id')->nullable()->constrined('genders')->nullOnDelete();
            $table->date('birth_date');
            $table->string('house_number');
            $table->foreignId('barangay_id')->nullable()->constrained('barangays')->nullOnDelete();
            $table->foreignId('district_id')->nullable()->constraned('districts')->nullOnDelete();
            $table->enum('city',['Taguig City']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_infos');
    }
};
