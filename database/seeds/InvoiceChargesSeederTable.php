<?php

use Illuminate\Database\Seeder;

class InvoiceChargesSeederTable extends Seeder
{
	private $invoiceCharges = [
		['invoicenum_charge'=>'00551198', 'trackingno'=>'1Z2F12346861507266', 'chargetype'=>'FRT', 'chargeamount'=>40],
		['invoicenum_charge'=>'00551198', 'trackingno'=>'1Z2F12346861507266', 'chargetype'=>'FUE', 'chargeamount'=>11],
		['invoicenum_charge'=>'00551198', 'trackingno'=>'1Z2F12346861507267', 'chargetype'=>'FRT', 'chargeamount'=>65],
		['invoicenum_charge'=>'00551198', 'trackingno'=>'1Z2F12346861507267', 'chargetype'=>'FUE', 'chargeamount'=>17],
		['invoicenum_charge'=>'00551198', 'trackingno'=>'1Z2F12346861507268', 'chargetype'=>'FRT', 'chargeamount'=>10],
		['invoicenum_charge'=>'00551198', 'trackingno'=>'1Z2F12346861507268', 'chargetype'=>'FUE', 'chargeamount'=>5],
		['invoicenum_charge'=>'00551198', 'trackingno'=>'1Z2F12346861507268', 'chargetype'=>'HAZ', 'chargeamount'=>5.5],
		['invoicenum_charge'=>'00551199', 'trackingno'=>'1Z2F12346861503423', 'chargetype'=>'FRT', 'chargeamount'=>8],
		['invoicenum_charge'=>'00551199', 'trackingno'=>'1Z2F12346861503423', 'chargetype'=>'FUE', 'chargeamount'=>2.5],
	];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
			DB::table('invoicecharges')->insert($this->invoiceCharges);
		}
}
