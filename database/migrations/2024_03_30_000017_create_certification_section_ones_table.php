<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('certification_section_ones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->default(5); // 5 for certifications
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certification_section_ones');
    }
};
