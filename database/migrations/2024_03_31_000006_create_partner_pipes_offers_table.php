<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('partner_pipes_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained()->onDelete('cascade');
            $table->longText('image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partner_pipes_offers');
    }
};
