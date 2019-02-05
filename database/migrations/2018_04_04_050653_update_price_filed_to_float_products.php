<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Product;

class UpdatePriceFiledToFloatProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        $products=Product::all();
//        foreach($products as $product){
//            if($product->citympg===''){
//                //dd('sf');
//                $product->citympg = '10';
//                $product->save();
//            }
//            if($product->highwaympg===''){
//                $product->highwaympg='10';
//                $product->save();
//            }
//        }
        $DBcolumns = Schema::getColumnListing('products');


        Schema::table('products', function (Blueprint $table) use($DBcolumns) {
            foreach($DBcolumns as $column)
            {
                if(strstr($column,'price'))
                {
                    $table->float($column,2)->change();
                }
                else if(strstr($column,'mpg'))
                {

                    $table->float($column,2)->change();
                }
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
