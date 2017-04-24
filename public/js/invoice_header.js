/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(1);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

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

/***/ })
/******/ ]);
//# sourceMappingURL=invoice_header.js.map