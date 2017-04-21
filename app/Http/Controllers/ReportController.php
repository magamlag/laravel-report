<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
            $date1 = $request->input('date1') ?: '01/01/1970';
            $date2 = $request->input('date2') ?: Carbon::now();

        $result = DB::select(
            DB::raw("SELECT in_h.*, sum(in_d.detailamount) as total, in_d.* FROM `invoiceheader` in_h 
              LEFT JOIN `invoicedetail` in_d ON in_h.invoicenum_header=in_d.invoicenum_detail 
              WHERE invoicedate BETWEEN :date1 AND :date2"),['date1'=>$date1,'date2'=>$date2]);

        return \Response::json(array(
            'success' => true,
            'data'   => $result
        ));

    }

}
