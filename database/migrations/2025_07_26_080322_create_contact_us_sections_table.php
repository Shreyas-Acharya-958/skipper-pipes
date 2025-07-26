<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_us_sections', function (Blueprint $table) {
            $table->id();
            $table->text('section1')->nullable();
            $table->text('section2')->nullable();
            $table->text('section3')->nullable();
            $table->text('section4')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_us_sections');
    }
};
