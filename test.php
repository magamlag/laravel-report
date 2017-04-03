<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema;

    $s = \Schema::create('invoiceheader', function (Blueprint $table) {
      $table->integer('invoicenum_header')->unsigned();
      $table->date('invoicedate');
      $table->float('invoiceamount');
    })->toSQL();
return;