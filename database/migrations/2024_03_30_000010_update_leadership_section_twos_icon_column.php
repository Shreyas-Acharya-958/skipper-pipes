<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('leadership_section_twos', function (Blueprint $table) {
            $table->string('icon')->nullable()->comment('Stores the file path for the icon image')->change();
        });
    }

    public function down()
    {
        Schema::table('leadership_section_twos', function (Blueprint $table) {
            $table->string('icon')->nullable()->comment('Stores the icon class name')->change();
        });
    }
};
