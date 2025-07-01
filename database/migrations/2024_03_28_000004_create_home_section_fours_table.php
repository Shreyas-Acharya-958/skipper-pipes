<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_section_fours', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Person reviews table for section 4
        Schema::create('home_section_four_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_four_id')->constrained('home_section_fours')->onDelete('cascade');
            $table->string('person_image')->nullable();
            $table->string('person_name')->nullable();
            $table->string('person_role')->nullable();
            $table->string('star')->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_section_four_reviews');
        Schema::dropIfExists('home_section_fours');
    }
};