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
        Schema::table('menu_seo_metadata', function (Blueprint $table) {
            $table->string('canonical_url')->nullable();
            $table->string('robots')->nullable();

            // Open Graph
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->nullable();

            // Twitter
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();
            $table->string('twitter_card')->nullable();

            // Custom Schema (JSON-LD)
            $table->longText('schema_json')->nullable();
            $table->longText('custom_schema_json')->nullable();

            $table->index(['meta_title', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_seo_metadata', function (Blueprint $table) {
            $table->dropColumn([
                'canonical_url',
                'robots',
                'og_title',
                'og_description',
                'og_image',
                'og_type',
                'twitter_title',
                'twitter_description',
                'twitter_image',
                'twitter_card',
                'schema_json',
                'custom_schema_json'
            ]);

            $table->dropIndex(['meta_title', 'menu_id']);
        });
    }
};
