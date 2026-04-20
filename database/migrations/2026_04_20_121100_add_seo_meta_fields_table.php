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
        
        Schema::table('sections', function (Blueprint $table) {
        
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->text('meta_keywords')->nullable();
        if (!Schema::hasColumn('sections', 'canonical_url')) {
            $table->string('canonical_url')->nullable();
        }

        if (!Schema::hasColumn('sections', 'robots')) {
            $table->string('robots')->nullable();
        }

        if (!Schema::hasColumn('sections', 'og_title')) {
            $table->string('og_title')->nullable();
        }

        if (!Schema::hasColumn('sections', 'og_description')) {
            $table->text('og_description')->nullable();
        }

        if (!Schema::hasColumn('sections', 'og_image')) {
            $table->string('og_image')->nullable();
        }

        if (!Schema::hasColumn('sections', 'og_type')) {
            $table->string('og_type')->nullable();
        }

        if (!Schema::hasColumn('sections', 'twitter_title')) {
            $table->string('twitter_title')->nullable();
        }

        if (!Schema::hasColumn('sections', 'twitter_description')) {
            $table->text('twitter_description')->nullable();
        }

        if (!Schema::hasColumn('sections', 'twitter_image')) {
            $table->string('twitter_image')->nullable();
        }

        if (!Schema::hasColumn('sections', 'twitter_card')) {
            $table->string('twitter_card')->nullable();
        }

        if (!Schema::hasColumn('sections', 'schema_json')) {
            $table->longText('schema_json')->nullable();
        }

        if (!Schema::hasColumn('sections', 'custom_schema_json')) {
            $table->longText('custom_schema_json')->nullable();
        }

        if (!Schema::hasColumn('sections', 'faq_json')) {
            $table->json('faq_json')->nullable();
        }               // optional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title','meta_description','meta_keywords',
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
                'custom_schema_json',
                'faq_json'
            ]);
        });
    }
};
