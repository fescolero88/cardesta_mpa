<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSubOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sub_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("product_id");
            $table->unsignedInteger("product_options_cat_id");
            $table->unsignedInteger("product_options_type_id");
            $table->unsignedInteger("product_options_sub_type_id");
            $table->boolean("value")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sub_options');
    }
}
