<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->longText('guide_content')->nullable();
            $table->string('brochure')->nullable();
            $table->string('technical_brochure')->nullable();
        });

        foreach ([
            'production_overview_sections',
            'production_application_sections',
            'production_features_sections',
            'production_faq_sections',
        ] as $sectionTable) {
            Schema::table($sectionTable, function (Blueprint $table) {
                $table->foreignId('product_category_id')->nullable()->after('product_id')->constrained('product_categories')->cascadeOnDelete();
                $table->foreignId('product_id')->nullable()->change();
            });
        }

        Schema::table('product_inquiries', function (Blueprint $table) {
            $table->foreignId('product_category_id')->nullable()->after('product_id')->constrained('product_categories')->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        foreach ([
            'production_overview_sections',
            'production_application_sections',
            'production_features_sections',
            'production_faq_sections',
        ] as $sectionTable) {
            if (Schema::hasColumn($sectionTable, 'product_id')) {
                DB::table($sectionTable)->whereNull('product_id')->delete();
            }

            $foreignKeys = Schema::getForeignKeys($sectionTable);
            $productForeignKey = null;

            foreach ($foreignKeys as $foreignKey) {
                if (in_array('product_category_id', $foreignKey['columns'], true)) {
                    Schema::table($sectionTable, function (Blueprint $table) use ($foreignKey) {
                        $table->dropForeign($foreignKey['name']);
                    });
                }

                if (in_array('product_id', $foreignKey['columns'], true)) {
                    $productForeignKey = $foreignKey;
                    Schema::table($sectionTable, function (Blueprint $table) use ($foreignKey) {
                        $table->dropForeign($foreignKey['name']);
                    });
                }
            }

            if (Schema::hasColumn($sectionTable, 'product_category_id')) {
                Schema::table($sectionTable, function (Blueprint $table) {
                    $table->dropColumn('product_category_id');
                });
            }

            if (Schema::hasColumn($sectionTable, 'product_id')) {
                Schema::table($sectionTable, function (Blueprint $table) {
                    $table->foreignId('product_id')->nullable(false)->change();
                });

                if ($productForeignKey) {
                    Schema::table($sectionTable, function (Blueprint $table) {
                        $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
                    });
                }
            }
        }

        if (Schema::hasColumn('product_inquiries', 'product_id')) {
            DB::table('product_inquiries')->whereNull('product_id')->delete();
        }

        $inquiryForeignKeys = Schema::getForeignKeys('product_inquiries');
        $inquiryProductForeignKey = null;

        foreach ($inquiryForeignKeys as $foreignKey) {
            if (in_array('product_category_id', $foreignKey['columns'], true)) {
                Schema::table('product_inquiries', function (Blueprint $table) use ($foreignKey) {
                    $table->dropForeign($foreignKey['name']);
                });
            }

            if (in_array('product_id', $foreignKey['columns'], true)) {
                $inquiryProductForeignKey = $foreignKey;
                Schema::table('product_inquiries', function (Blueprint $table) use ($foreignKey) {
                    $table->dropForeign($foreignKey['name']);
                });
            }
        }

        if (Schema::hasColumn('product_inquiries', 'product_category_id')) {
            Schema::table('product_inquiries', function (Blueprint $table) {
                $table->dropColumn('product_category_id');
            });
        }

        if (Schema::hasColumn('product_inquiries', 'product_id')) {
            Schema::table('product_inquiries', function (Blueprint $table) {
                $table->foreignId('product_id')->nullable(false)->change();
            });

            if ($inquiryProductForeignKey) {
                Schema::table('product_inquiries', function (Blueprint $table) {
                    $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
                });
            }
        }

        $categoryColumns = array_filter(
            ['guide_content', 'brochure', 'technical_brochure'],
            fn ($column) => Schema::hasColumn('product_categories', $column)
        );

        if ($categoryColumns) {
            Schema::table('product_categories', function (Blueprint $table) use ($categoryColumns) {
                $table->dropColumn($categoryColumns);
            });
        }
    }
};
