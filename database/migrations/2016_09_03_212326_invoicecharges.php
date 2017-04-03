<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invoicecharges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('invoicecharges', function (Blueprint $table) {
            $table->string('invoicenum_charge');
            $table->string('trackingno');
            $table->string('chargetype');
            $table->float('chargeamount');
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
        Schema::drop('invoicecharges');
    }
}
