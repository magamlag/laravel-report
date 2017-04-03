<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ReportController@index');

Route::post('/show', 'ReportController@showReport');

// Begin InvoiceDetail Routes

Route::any('api/invoice-detail', 'ApiController@invoiceDetailData');
Route::any('api/invoice-detail-vue', 'ApiController@invoiceDetailVueData');
Route::resource('invoice-detail', 'InvoiceDetailController');
// End InvoiceDetail Routes

// Begin InvoiceDetail Chart Route
Route::get('api/invoice-detail-chart', 'ApiController@invoiceDetailChartData');
// End InvoiceDetail Chart Route

// Begin InvoiceHeader Routes
Route::any('api/invoice-header', 'ApiController@invoiceHeaderData');
Route::any('api/invoice-header-vue', 'ApiController@invoiceHeaderVueData');
Route::resource('invoice-header', 'InvoiceHeaderController');
// End InvoiceHeader Routes

// Begin InvoiceHeader Chart Route
Route::get('api/invoice-header-chart', 'ApiController@invoiceHeaderChartData');
// End InvoiceHeader Chart Route