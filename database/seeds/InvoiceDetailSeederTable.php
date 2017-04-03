<?php

use Illuminate\Database\Seeder;

class InvoiceDetailSeederTable extends Seeder
{

	private $invoiceDetails = [
			['invoicenum_detail'=>'00551198', 'trackingno'=>'1Z2F12346861507266', 'detailamount'=>50],
			['invoicenum_detail'=>'00551198', 'trackingno'=>'1Z2F12346861507267', 'detailamount'=>80],
			['invoicenum_detail'=>'00551198', 'trackingno'=>'1Z2F12346861507268', 'detailamount'=>20.5],
			['invoicenum_detail'=>'00551199', 'trackingno'=>'1Z2F12346861503423', 'detailamount'=>10.5],
	];

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
			DB::table('invoicedetail')->insert($this->invoiceDetails);
		}
}
