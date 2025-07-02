<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leadership_section_fours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->default(2); // 2 for leadership
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->string('role')->nullable();
            $table->text('description')->nullable(); // textarea
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leadership_section_fours');
    }
};
