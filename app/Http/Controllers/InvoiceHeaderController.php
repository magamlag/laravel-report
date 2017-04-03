<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\InvoiceHeader;
use Illuminate\Support\Facades\Redirect;

class InvoiceHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('invoice-header.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice-header.create');
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
            'invoice_header_name' => 'required|unique:invoiceheader|string|max:30',

        ]);

        $invoiceHeader = InvoiceHeader::create(['invoice_header_name' => $request->invoice_header_name]);
        $invoiceHeader->save();

        return Redirect::route('invoice-header.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoiceHeader = InvoiceHeader::findOrFail($id);

        return view('invoice-header.show', compact('invoiceHeader'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoiceHeader = InvoiceHeader::findOrFail($id);

        return view('invoice-header.edit', compact('invoiceHeader'));
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
            'invoice_header_name' => 'required|string|max:40|unique:invoiceheader,invoice_header_name,' .$id

        ]);
        $invoiceHeader = InvoiceHeader::findOrFail($id);
        $invoiceHeader->update(['invoice_header_name' => $request->invoice_header_name]);


        return Redirect::route('invoice-header.show', ['invoiceHeader' => $invoiceHeader]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InvoiceHeader::destroy($id);

        return Redirect::route('invoice-header.index');
    }
}