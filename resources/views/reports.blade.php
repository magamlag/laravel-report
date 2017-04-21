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
<script type="text/javascript">
	$(function () {
		let $datatimepicker = $('#datetimepicker1, #datetimepicker2');

		let showResultTable = function (data) {
			let $tableResult = $("#table-result");
			let $tbody = $tableResult.find("tbody");
			let dataForTable = data.data;
			let trs = '';

			for (let i = 0; i < dataForTable.length; i++) {
				trs += '<tr>';
				for (prop in dataForTable[i]) {
					if (dataForTable[i].hasOwnProperty(prop)) {
						trs += "<td>" + dataForTable[i][prop] + "</td>";
					}
				}
			}

			$tbody.append(trs);
			$tableResult.show();
		};

		$datatimepicker.datetimepicker({
			format   : 'DD/MM/YYYY',
			showClose: true
		});
      /*,
       }).on('changeDate', function(ev){
       $datatimepicker.datepicker('hide');
       });*/
		let ajaxGetDataForTable = function (e) {
			e.preventDefault();
			let date = {
				report: $('#report_num').val(),
				date1 : $("#datetimepicker1").find('input').val(),
				date2 : $("#datetimepicker2").find('input').val()
			};

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
				}
			});

			$.ajax({
				type    : 'POST',
				url     : 'show',
				data    : date,
				dataType: 'json',
				success : showResultTable
			});

		};

		$('#submit').on('click', ajaxGetDataForTable);
	});
</script>
</body>
</html>
