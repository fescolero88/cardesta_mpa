<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCallTrackingNoLeadEmailDistance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealer', function (Blueprint $table) {
            $table->string('call_tracking_no')->nullable();
            $table->string('lead_email')->nullable();
            $table->string('distance')->nullable();
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
            $table->dropColumn(['call_tracking_no','lead_email','distance']);
        });
    }
}
