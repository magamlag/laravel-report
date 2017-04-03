<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{

		protected $table = 'invoiceheader';
		public $timestamps = false;
    protected $fillable = ['invoicenum_header','invoiceamount','invoicedate'];
}