<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Main section table
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->json('images')->nullable();
            $table->timestamps();
        });

        // Why Skipper section table
        Schema::create('career_why_skippers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->json('images')->nullable();
            $table->timestamps();
        });

        // Life at Skipper section table
        Schema::create('career_life_at_skippers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // Skipper Pipes section table
        Schema::create('career_skipper_pipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('careers');
        Schema::dropIfExists('career_why_skippers');
        Schema::dropIfExists('career_life_at_skippers');
        Schema::dropIfExists('career_skipper_pipes');
    }
};
