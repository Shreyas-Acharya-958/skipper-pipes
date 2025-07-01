<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('home_section_ones', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Features table for section 1
        Schema::create('home_section_one_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_one_id')->constrained('home_section_ones')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('status')->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_section_one_features');
        Schema::dropIfExists('home_section_ones');
    }
};
