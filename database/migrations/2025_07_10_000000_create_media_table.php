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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('file_type', ['video', 'youtube_link', 'image', 'pdf']);
            $table->string('file')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('media_type', ['Company', 'Events', 'Awards'])->default('Company'); // media type
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
