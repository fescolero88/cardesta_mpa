<?php

use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDateinstockToDateField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

//        $data = Product::all();
//
//        foreach($data as $row)
//        {
//            $row->dateinstock = Carbon::parse($row->dateinstock)->format('Y-m-d');
//            $row->save();
//        }

        Schema::table('products', function (Blueprint $table) {
            $table->date('dateinstock')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('dateinstock')->change();
        });
    }
}
