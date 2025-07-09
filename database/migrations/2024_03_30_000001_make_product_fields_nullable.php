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
        Schema::table('products', function (Blueprint $table) {
            $table->text('product_overview')->nullable()->change();
            $table->text('features_benefits')->nullable()->change();
            $table->text('technical')->nullable()->change();
            $table->text('application')->nullable()->change();
            $table->text('faq')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('product_overview')->nullable(false)->change();
            $table->text('features_benefits')->nullable(false)->change();
            $table->text('technical')->nullable(false)->change();
            $table->text('application')->nullable(false)->change();
            $table->text('faq')->nullable(false)->change();
        });
    }
};
