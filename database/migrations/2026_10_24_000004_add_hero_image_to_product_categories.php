<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('product_categories', 'hero_image')) {
            Schema::table('product_categories', function (Blueprint $table) {
                $table->string('hero_image')->nullable()->after('image');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('product_categories', 'hero_image')) {
            Schema::table('product_categories', function (Blueprint $table) {
                $table->dropColumn('hero_image');
            });
        }
    }
};
