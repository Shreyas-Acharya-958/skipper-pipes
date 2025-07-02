<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('overview_section_threes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->default(1); // 1 for overview
            $table->string('icon')->nullable(); // text_box
            $table->string('title')->nullable();
            $table->text('description')->nullable(); // textarea
            $table->string('type')->nullable(); // To differentiate between Mission and Philosophy
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('overview_section_threes');
    }
};
