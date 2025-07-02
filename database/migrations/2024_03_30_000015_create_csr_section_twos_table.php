<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('csr_section_twos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->default(4); // 4 for csr
            $table->string('icon')->nullable(); // text_box
            $table->string('title')->nullable();
            $table->text('description')->nullable(); // textarea
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('csr_section_twos');
    }
};
