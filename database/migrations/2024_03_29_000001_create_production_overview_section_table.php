<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('production_overview_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->text('overview_description')->nullable();
            $table->json('overview_image')->nullable(); // For multiple images (max 5)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('production_overview_sections');
    }
};