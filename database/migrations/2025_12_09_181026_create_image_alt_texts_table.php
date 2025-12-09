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
        Schema::create('image_alt_texts', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->unique(); // Full path like /assets/img/logo.png or /storage/products/image.jpg
            $table->string('normalized_path')->unique(); // Normalized for matching (lowercase, normalized slashes)
            $table->text('alt_text')->nullable(); // Alternative text
            $table->string('file_name')->nullable(); // Just the filename for display
            $table->string('directory')->nullable(); // Directory path
            $table->integer('file_size')->nullable(); // File size in bytes
            $table->timestamps();
            
            $table->index('normalized_path');
            $table->index('directory');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_alt_texts');
    }
};
