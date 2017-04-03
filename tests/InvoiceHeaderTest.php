<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoiceHeaderTest extends TestCase
{
    public function testCreateNewInvoiceHeader()
    {

        $randomString = str_random(10);

        $this->visit('/invoice-header/create')
              ->type($randomString, 'invoice_header_name')
              ->press('Create')
              ->seePageIs('/invoice-header');
    }
}