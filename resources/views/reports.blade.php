<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

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
        .jumbotron{
            margin-top:20px;
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
                        <input type='text' class="form-control" placeholder="MM/DD/YYYY"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class='col-sm-6'>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' class="form-control" placeholder="MM/DD/YYYY"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <button id="submit" class="btn btn-default">Submit</button>
       </form>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var $datatimepicker = $('#datetimepicker1, #datetimepicker2');
        $datatimepicker.datetimepicker({
            format: 'DD/MM/YYYY',
            showClose: true
        });/*,
        }).on('changeDate', function(ev){
              $datatimepicker.datepicker('hide');
          });*/

        $('#submit').on('click', function (e) {
            // console.log('dp.show or dp.change event');
            var date = {
                report: $('#report_num').val(),
                date1: $("#datetimepicker1").find('input').val(),
                date2: $("#datetimepicker2").find('input').val()
            };
            console.log(date);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'show',
                data: date,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
