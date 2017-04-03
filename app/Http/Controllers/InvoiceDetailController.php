<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\InvoiceDetail;
use Illuminate\Support\Facades\Redirect;

class InvoiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('invoice-detail.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice-detail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'invoice_detail_name' => 'required|unique:invoice_details|string|max:30',

        ]);

        $invoiceDetail = InvoiceDetail::create(['invoice_detail_name' => $request->invoice_detail_name]);
        $invoiceDetail->save();

        return Redirect::route('invoice-detail.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoiceDetail = InvoiceDetail::findOrFail($id);

        return view('invoice-detail.show', compact('invoiceDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoiceDetail = InvoiceDetail::findOrFail($id);

        return view('invoice-detail.edit', compact('invoiceDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'invoice_detail_name' => 'required|string|max:40|unique:invoice_details,invoice_detail_name,' .$id

        ]);
        $invoiceDetail = InvoiceDetail::findOrFail($id);
        $invoiceDetail->update(['invoice_detail_name' => $request->invoice_detail_name]);


        return Redirect::route('invoice-detail.show', ['invoiceDetail' => $invoiceDetail]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InvoiceDetail::destroy($id);

        return Redirect::route('invoice-detail.index');
    }
}