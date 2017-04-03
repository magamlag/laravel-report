<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
				$from_date = '2014-01-01';
				$to_date = '2015-01-01';
				$reports = DB::table('invoiceheader')
						->select('*', DB::raw('COUNT(invoicenum_header) as total_num'),DB::raw('SUM(invoiceamount) as total_amount'))
						->whereBetween('invoicedate',[$from_date,$to_date])
						->groupBy('invoicenum_header')
						->get();
        return view('reports', $reports);
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showReport(Request $request)
    {
        //
            $date1 = $request->input('date1');
            $date2 = $request->input('date2');

        $result = DB::select(
            DB::raw("SELECT invoiceheader.*, sum(detailamount) as total, invoicedetail.* FROM `invoiceheader` LEFT JOIN `invoicedetail` ON invoiceheader.invoicenum_header=invoicedetail.invoicenum_detail where invoicedate between :date1 and :date2"),['date1'=>$date1,'date2'=>$date2]);

        return \Response::json(array(
            'success' => true,
            'data'   => $result
        ));

    }

}
