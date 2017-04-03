@extends('layouts.master')

@section('title')

    <title>Create a InvoiceHeader</title>

@endsection

@section('content')

        <ol class='breadcrumb'><li><a href='/'>Home</a></li><li><a href='/invoice-header'>InvoiceHeaders</a></li><li class='active'>Create</li></ol>

        <h2>Create a New InvoiceHeader</h2>

        <hr/>


        <form class="form" role="form" method="POST" action="{{ url('/invoice-header') }}">

        {!! csrf_field() !!}

        <!-- invoice_header_name Form Input -->
            <div class="form-group{{ $errors->has('invoice_header_name') ? ' has-error' : '' }}">
                <label class="control-label">InvoiceHeader Name</label>

                    <input type="text" class="form-control" name="invoice_header_name" value="{{ old('invoice_header_name') }}">

                    @if ($errors->has('invoice_header_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('invoice_header_name') }}</strong>
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