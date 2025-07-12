<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Main section table
        Schema::create('why_skipper_pipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Why Skipper Pipes? section table
        Schema::create('why_skipper_pipe_section_threes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // India's Infrastructure section table
        Schema::create('why_skipper_pipe_section_fours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Quality That Speaks section table
        Schema::create('why_skipper_pipe_section_fives', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // Built for Every Condition section table
        Schema::create('why_skipper_pipe_section_twos', function (Blueprint $table) {
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
        Schema::dropIfExists('why_skipper_pipes');
        Schema::dropIfExists('why_skipper_pipe_section_threes');
        Schema::dropIfExists('why_skipper_pipe_section_fours');
        Schema::dropIfExists('why_skipper_pipe_section_fives');
        Schema::dropIfExists('why_skipper_pipe_section_twos');
    }
};
