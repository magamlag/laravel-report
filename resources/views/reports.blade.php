<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>

    <!-- JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.42/js/bootstrap-datetimepicker.min.js"></script>
    <!-- END -- JS -->
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.42/css/bootstrap-datetimepicker.min.css" />
    <!-- END -- CSS -->
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <style>
        .jumbotron {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        Header
    </div>
    <div class="row">
        <form id="form-report1">
            <input type="hidden" value="1" id="report_num">
            <div class='col-sm-6'>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" placeholder="MM/DD/YYYY" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class='col-sm-6'>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' class="form-control" placeholder="MM/DD/YYYY" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <button id="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div class="row">
        <table id="table-result" class="table" hidden>
            <thead class="thead-inverse">
            <th>DetailAmount</th>
            <th>InvoiceAmount</th>
            <th>InvoiceDate</th>
            <th>InvoiceNumDetail</th>
            <th>InvoiceNumHeader</th>
            <th>TrackIgno</th>
            <th>Total</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<script src="{{ elixir('js/invoice_header.js') }}"></script>

</body>
</html>
