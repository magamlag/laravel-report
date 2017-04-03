@extends('layouts.master')

@section('title')

    <title>Create a InvoiceDetail</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/invoice-detail'>InvoiceDetails</a></li><li class='active'>Create</li></ol>

        <h2>Create a New InvoiceDetail</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/invoice-detail') }}">

        {!! csrf_field() !!}

        <!-- invoice_detail_name Form Input -->
            <div class="form-group{{ $errors->has('invoice_detail_name') ? ' has-error' : '' }}">
                <label class="control-label">InvoiceDetail Name</label>

                    <input type="text" class="form-control" name="invoice_detail_name" value="{{ old('invoice_detail_name') }}">

                    @if ($errors->has('invoice_detail_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('invoice_detail_name') }}</strong>
                                    </span>
                    @endif

            </div>


            <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Create
                    </button>
            </div>

        </form>

@endsection