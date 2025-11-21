<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'sequence')) {
                $table->integer('sequence')->default(0)->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'sequence')) {
                $table->dropColumn('sequence');
            }
        });
    }
};
