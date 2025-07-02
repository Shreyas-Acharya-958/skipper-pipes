<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leadership_section_ones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->default(2); // 2 for leadership
            $table->string('image')->nullable();
            $table->longText('description')->nullable(); // tinyeditor
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leadership_section_ones');
    }
};
