<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('company_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('page_image')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->longText('section_1')->nullable();
            $table->longText('section_2')->nullable();
            $table->longText('section_3')->nullable();
            $table->longText('section_4')->nullable();
            $table->longText('section_5')->nullable();
            $table->longText('section_6')->nullable();
            $table->longText('section_7')->nullable();
            $table->longText('section_8')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('status');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_pages');
    }
};
