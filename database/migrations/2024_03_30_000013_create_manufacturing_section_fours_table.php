<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('manufacturing_section_fours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->default(3); // 3 for manufacturing

            $table->string('image')->nullable();
            $table->longText('description')->nullable(); // tinyeditor
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manufacturing_section_fours');
    }
};
