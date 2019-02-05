<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDealerSlugToDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealer', function (Blueprint $table) {
            $table->string('dealer_slug')->nullable();
        });

        $dealers = \App\Dealer::all();

        $dealers->map(function($dealer){
            $slug = !empty($dealer->name) ? str_slug($dealer->name) : 'car-dealer-solutions-'.$dealer->dealer_id;
            $dealer->dealer_slug = $slug;
            $dealer->save();
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
            $table->dropColumn('dealer_slug');
        });
    }
}
