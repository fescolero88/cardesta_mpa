<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImportedFieldToProductImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_image', function (Blueprint $table) {
            $table->tinyInteger('imported')->default(0);
            $table->text('original_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_image', function (Blueprint $table) {
            $table->dropColumn(['imported','original_url']);
        });
    }
}
