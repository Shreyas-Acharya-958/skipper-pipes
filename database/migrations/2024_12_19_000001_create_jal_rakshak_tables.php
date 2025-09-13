<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tab 1: Menus (title, url multiple rows)
        Schema::create('jal_rakshak_menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // Tab 2: Banner Images
        Schema::create('jal_rakshak_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });

        // Tab 3: About the Initiative (image, title, description)
        Schema::create('jal_rakshak_initiatives', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        // Tab 4: Offline Activities Showcase (image, title, description multiple rows)
        Schema::create('jal_rakshak_activities', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description');
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // Tab 5: Photo Gallery (individual images multiple rows)
        Schema::create('jal_rakshak_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // Tab 6: Videos (video link multiple rows)
        Schema::create('jal_rakshak_videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_url');
            $table->string('title')->nullable();
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // Tab 7: Water Conservation (image, title, description multiple rows)
        Schema::create('jal_rakshak_conservations', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('description');
            $table->integer('sequence')->default(0);
            $table->timestamps();
        });

        // Tab 8: Get Involved (image, head title, form title)
        Schema::create('jal_rakshak_involvements', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('head_title');
            $table->string('form_title');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tab 9: SEO (single entry)
        Schema::create('jal_rakshak_seos', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jal_rakshak_menus');
        Schema::dropIfExists('jal_rakshak_banners');
        Schema::dropIfExists('jal_rakshak_initiatives');
        Schema::dropIfExists('jal_rakshak_activities');
        Schema::dropIfExists('jal_rakshak_galleries');
        Schema::dropIfExists('jal_rakshak_videos');
        Schema::dropIfExists('jal_rakshak_conservations');
        Schema::dropIfExists('jal_rakshak_involvements');
        Schema::dropIfExists('jal_rakshak_seos');
    }
};
