<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteCascadeOnProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_options', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->change();

             $table->foreign('product_options_cat_id')
                ->references('id')->on('options_type_category')
                ->onDelete('cascade')
                ->change();
                
            $table->foreign('product_options_type_id')
                ->references('id')->on('options_types')
                ->onDelete('cascade')
                ->change();    
        });
    
        Schema::table('products_image', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_options', function (Blueprint $table) {
            $table->dropForeign('product_options_product_id_foreign');
            $table->dropForeign('product_options_product_options_cat_id_foreign');
            $table->dropForeign('product_options_product_options_type_id_foreign');
        });
    
        Schema::table('products_image', function (Blueprint $table) {
            $table->dropForeign('products_image_product_id_foreign');
        });
    }
}
