<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLatLngFieldToDoubleDealer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealer', function (Blueprint $table) {
            $table->dropColumn('feed_type');
        });

        Schema::table('dealer', function (Blueprint $table) {
            $table->float('latitude',2,2)->change();
            $table->float('longitude',2,2)->change();
        });

        Schema::table('dealer', function (Blueprint $table) {
            $table->string('feed_type')->default('M');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dealer', function (Blueprint $table) {
            $table->string('latitude')->nullable()->change();
            $table->string('longitude')->nullable()->change();
        });
    }
}
