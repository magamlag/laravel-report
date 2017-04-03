<?php

use Illuminate\Database\Seeder;

class InvoiceHeaderSeederTable extends Seeder
{
	private $invoiceHeader = [
			['invoicenum_header'=>'00551198', 'invoicedate'=>'2014-01-01', 'invoiceamount'=>50],
			['invoicenum_header'=>'00551198', 'invoicedate'=>'2014-01-01', 'invoiceamount'=>80],
	];

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
			DB::table('invoiceheader')->insert($this->invoiceHeader);
    }
}
