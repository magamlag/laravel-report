<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoiceDetailTest extends TestCase
{
    public function testCreateNewInvoiceDetail()
    {

        $randomString = str_random(10);

        $this->visit('/invoice-detail/create')
              ->type($randomString, 'invoice_detail_name')
              ->press('Create')
              ->seePageIs('/invoice-detail');
    }
}