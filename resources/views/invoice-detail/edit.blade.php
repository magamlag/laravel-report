@extends('layouts.master')

@section('title')

    <title>Edit InvoiceDetail</title>

@endsection

@section('content')


        <ol class='breadcrumb'>
        <li><a href='/'>Home</a></li>
        <li><a href='/invoice-detail'>InvoiceDetails</a></li>
        <li><a href='/invoice-detail/{{$invoiceDetail->id}}'>{{$invoiceDetail->invoice_detail_name}}</a></li>
        <li class='active'>Edit</li>
        </ol>

        <h1>Edit InvoiceDetail</h1>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/invoice-detail/'. $invoiceDetail->id) }}">
        <input type="hidden" name="_method" value="patch">
        {!! csrf_field() !!}

        <!-- invoice_detail_name Form Input -->
            <div class="form-group{{ $errors->has('invoice_detail_name') ? ' has-error' : '' }}">
                <label class="control-label">InvoiceDetail Name</label>

                    <input type="text" class="form-control" name="invoice_detail_name" value="{{ $invoiceDetail->invoice_detail_name }}">

                    @if ($errors->has('invoice_detail_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('invoice_detail_name') }}</strong>
                                    </span>
                    @endif

            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Edit
                    </button>
            </div>

        </form>


@endsection