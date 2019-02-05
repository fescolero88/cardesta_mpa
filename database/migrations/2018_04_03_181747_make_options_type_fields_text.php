<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeOptionsTypeFieldsText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('options_types', function (Blueprint $table) {
            $table->text("name")->change();
            $table->text("slug")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('options_types', function (Blueprint $table) {
            $table->string("name")->change();
            $table->string("slug")->change();
        });
    }
}
