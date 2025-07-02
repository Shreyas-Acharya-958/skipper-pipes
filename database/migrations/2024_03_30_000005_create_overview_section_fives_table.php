<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('overview_section_fives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->default(1); // 1 for overview
            $table->string('image')->nullable();
            $table->longText('description')->nullable(); // tinyeditor
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('overview_section_fives');
    }
};
