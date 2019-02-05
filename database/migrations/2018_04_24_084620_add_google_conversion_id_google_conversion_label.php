<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoogleConversionIdGoogleConversionLabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealer', function (Blueprint $table) {
            $table->bigInteger('google_conversion_id')->nullable();
            $table->text('google_conversion_label')->nullable();
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
            $table->dropColumn(['google_conversion_id','google_conversion_label']);
        });
    }
}
