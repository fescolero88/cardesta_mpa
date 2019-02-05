<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeedTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('dealer', function (Blueprint $table) {
            $table->tinyInteger('feed_type')->default(1);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->tinyInteger('feed_type')->default(1);
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
            $table->dropColumn(['feed_type']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['feed_type']);
        });
    }
}
