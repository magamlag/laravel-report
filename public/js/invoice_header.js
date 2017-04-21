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