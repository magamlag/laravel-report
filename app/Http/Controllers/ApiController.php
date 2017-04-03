<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class ApiController extends Controller
{

// Begin InvoiceHeader Chart Api Method

    public function invoiceHeaderChartData(Request $request){

        if ($request->has('period')){

            switch($request->get('period')){

                case '3months' :

                    // set first and last date

                    $currentYear = \Carbon\Carbon::now()->toDateString();
                    $lastYear = \Carbon\Carbon::parse('first day of -2 month')->toDateString();

                    $rows = DB::table('invoiceheader')->select(DB::raw('Year(created_at) as year'),
                        DB::raw('month(created_at) as month'),
                        DB::raw("count(invoiceheader.id) as `count`"))
                        ->where(DB::raw('date(created_at)'), '>=', $lastYear)
                        ->where(DB::raw('date(created_at)'), '<=', $currentYear)
                        ->groupBy('year', 'month')
                        ->get();

                    // dynamically create range of month/value pairs using carbon

                    for ($i = 0; $i <= 2; $i++) {
                        $values[intval(\Carbon\Carbon::parse("$lastYear + $i month")->format('m'))] = 0;
                    }

                    $months = [1 => 'Jan', 2 => 'Feb', 3 =>'Mar', 4 => 'Apr', 5 => 'May',
                               6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct',
                               11 => 'Nov', 12 => 'Dec'];

                    //replace keys in values where key in months matches key in values with value in months of matching key

                    $newValues = [];

                    foreach($values as $monthNumber => $count){

                        $key = $months[$monthNumber];
                        $newValues[$key] = $count;


                    }

                    $labels= array_keys($newValues);


                    foreach($rows as $row){

                        //overwrite values into values array

                        $values [$row->month] = $row->count;
                    }

                    $values = array_values($values);

                    $data['data'] = compact('labels', 'values');

                    return response()->json($data);

                    break;

                case '1week' :

                    // set first and last date

                    $today = \Carbon\Carbon::now()->toDateString();
                    $lastWeek = \Carbon\Carbon::parse('-6 days')->toDateString();

                    $rows = DB::table('invoiceheader')->select(DB::raw('day(created_at) as day'),
                        DB::raw('month(created_at) as month'),
                        DB::raw("count(invoiceheader.id) as `count`"))
                        ->where(DB::raw('date(created_at)'), '>=', $lastWeek)
                        ->where(DB::raw('date(created_at)'), '<=', $today)
                        ->groupBy('month', 'day')
                        ->get();

                    // dynamically create range of month/day pairs using carbon

                    for ($i = 0; $i <= 6; $i++) {
                        $labels[intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('m')) . '/' .intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d'))] = 0;
                    }

                    $labels= array_keys($labels);

                    for ($i = 0; $i <= 6; $i++) {
                        $values[intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d'))] = 0;
                    }

                    //assign each day counts to values


                    foreach($rows as $row){

                        $values [$row->day] = $row->count;
                    }


                    $values = array_values($values);

                    $data['data'] = compact('labels', 'values');

                    return response()->json($data);

                    break;

                case '30days' :

                    $today = \Carbon\Carbon::now()->toDateString();
                    $lastWeek = \Carbon\Carbon::parse('-29 days')->toDateString();

                    $rows = DB::table('invoiceheader')->select(DB::raw('day(created_at) as day'),
                        DB::raw('month(created_at) as month'),
                        DB::raw("count(invoiceheader.id) as `count`"))
                        ->where(DB::raw('date(created_at)'), '>=', $lastWeek)
                        ->where(DB::raw('date(created_at)'), '<=', $today)
                        ->groupBy('month', 'day')
                        ->get();


                    // dynamically create range of month/day pairs using carbon

                    for ($i = 0; $i <= 29; $i++) {
                        $labels[intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('m')) . '/' .intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d'))] = 0;
                    }

                    $labels= array_keys($labels);

                    // build values array

                    for ($i = 0; $i <= 29; $i++) {
                        $values[intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d'))] = 0;
                    }

                    //assign each day counts to values

                    foreach($rows as $row){

                        $values [$row->day] = $row->count;
                    }

                    $values = array_values($values);

                    $data['data'] = compact('labels', 'values');

                    return response()->json($data);

                    break;


            }


        }

        // set first and last date

        $currentYear = \Carbon\Carbon::now()->toDateString();
        $lastYear = \Carbon\Carbon::parse('first day of -11 month')->toDateString();

        $rows = DB::table('invoiceheader')->select(DB::raw('Year(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw("count(invoiceheader.id) as `count`"))
            ->where(DB::raw('date(created_at)'), '>=', $lastYear)
            ->where(DB::raw('date(created_at)'), '<=', $currentYear)
            ->groupBy('year', 'month')
            ->get();

        // dynamically create range of month/value pairs using carbon

        $values[intval(\Carbon\Carbon::parse($lastYear)->format('m'))] = 0;

        for ($i = 0; $i <= 11; $i++) {
            $values[intval(\Carbon\Carbon::parse("$lastYear + $i month")->format('m'))] = 0;
        }

        $months = [1 => 'Jan', 2 => 'Feb', 3 =>'Mar', 4 => 'Apr', 5 => 'May',
                   6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct',
                   11 => 'Nov', 12 => 'Dec'];

        //replace keys in values where key in months matches key in values with value in months of matching key

        $newValues = [];

       foreach($values as $monthNumber => $count){

           $key = $months[$monthNumber];
           $newValues[$key] = $count;


       }

        $labels= array_keys($newValues);


        foreach($rows as $row){

            //overwrite values into values array

            $values [$row->month] = $row->count;
        }

        $values = array_values($values);


        $currentYear = \Carbon\Carbon::parse($currentYear)->format('y');
        $lastYear = \Carbon\Carbon::parse($lastYear)->format('y');


        $data['data'] = compact('labels', 'values', 'currentYear', 'lastYear');

        return response()->json($data);



    }

    // End InvoiceHeader Chart Api Method




    // Begin InvoiceHeader Api Methods

    public function invoiceHeaderData(){

        $result['data'] = DB::table('invoiceheader')
                         ->select('id as Id',
                                  'invoice_header_name as Name',
                                  'created_at as Created')
                         ->get();

        return json_encode($result);

    }

    public function invoiceHeaderVueData(Request $request){

        $column = 'id';
        $direction = 'asc';

        if ($request->has('column')){

            $column = $request->get('column');
            if ($column == 'Id'){
                $direction = $request->get('direction') == 1 ? 'asc' : 'desc';
            } else {

                $direction = $request->get('direction') == 1 ? 'desc' : 'asc';
            }


        }

        if ($request->has('keyword')){

            $keyword = $request->get('keyword');

            $invoiceHeaders = DB::table('invoiceheader')
                ->select('id as Id',
                    'invoice_header_name as Name',
                    'created_at as Created')
                ->where('invoice_header_name', 'like', '%' . $keyword . '%')
                ->orderBy($column, $direction)
                ->paginate(10);

            return response()->json($invoiceHeaders);



        }

        $invoiceHeaders = DB::table('invoiceheader')
                             ->select('id as Id',
                                      'invoice_header_name as Name',
                                      'created_at as Created')
                             ->orderBy($column, $direction)
                             ->paginate(10);

        return response()->json($invoiceHeaders);

    }

    // End InvoiceHeader Api Methods




    // Begin InvoiceHeader Api Methods

    public function invoiceHeaderData(){

        $result['data'] = DB::table('invoiceheader')
                         ->select('id as Id',
                                  'invoice_header_name as Name',
                                  'created_at as Created')
                         ->get();

        return json_encode($result);

    }

    public function invoiceHeaderVueData(Request $request){

        $column = 'id';
        $direction = 'asc';

        if ($request->has('column')){

            $column = $request->get('column');
            if ($column == 'Id'){
                $direction = $request->get('direction') == 1 ? 'asc' : 'desc';
            } else {

                $direction = $request->get('direction') == 1 ? 'desc' : 'asc';
            }


        }

        if ($request->has('keyword')){

            $keyword = $request->get('keyword');

            $invoiceHeaders = DB::table('invoiceheader')
                ->select('id as Id',
                    'invoice_header_name as Name',
                    'created_at as Created')
                ->where('invoice_header_name', 'like', '%' . $keyword . '%')
                ->orderBy($column, $direction)
                ->paginate(10);

            return response()->json($invoiceHeaders);



        }

        $invoiceHeaders = DB::table('invoiceheader')
                             ->select('id as Id',
                                      'invoice_header_name as Name',
                                      'created_at as Created')
                             ->orderBy($column, $direction)
                             ->paginate(10);

        return response()->json($invoiceHeaders);

    }

    // End InvoiceHeader Api Methods



// Begin InvoiceDetail Chart Api Method

    public function invoiceDetailChartData(Request $request){

        if ($request->has('period')){

            switch($request->get('period')){

                case '3months' :

                    // set first and last date

                    $currentYear = \Carbon\Carbon::now()->toDateString();
                    $lastYear = \Carbon\Carbon::parse('first day of -2 month')->toDateString();

                    $rows = DB::table('invoice_details')->select(DB::raw('Year(created_at) as year'),
                        DB::raw('month(created_at) as month'),
                        DB::raw("count(invoice_details.id) as `count`"))
                        ->where(DB::raw('date(created_at)'), '>=', $lastYear)
                        ->where(DB::raw('date(created_at)'), '<=', $currentYear)
                        ->groupBy('year', 'month')
                        ->get();

                    // dynamically create range of month/value pairs using carbon

                    for ($i = 0; $i <= 2; $i++) {
                        $values[intval(\Carbon\Carbon::parse("$lastYear + $i month")->format('m'))] = 0;
                    }

                    $months = [1 => 'Jan', 2 => 'Feb', 3 =>'Mar', 4 => 'Apr', 5 => 'May',
                               6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct',
                               11 => 'Nov', 12 => 'Dec'];

                    //replace keys in values where key in months matches key in values with value in months of matching key

                    $newValues = [];

                    foreach($values as $monthNumber => $count){

                        $key = $months[$monthNumber];
                        $newValues[$key] = $count;


                    }

                    $labels= array_keys($newValues);


                    foreach($rows as $row){

                        //overwrite values into values array

                        $values [$row->month] = $row->count;
                    }

                    $values = array_values($values);

                    $data['data'] = compact('labels', 'values');

                    return response()->json($data);

                    break;

                case '1week' :

                    // set first and last date

                    $today = \Carbon\Carbon::now()->toDateString();
                    $lastWeek = \Carbon\Carbon::parse('-6 days')->toDateString();

                    $rows = DB::table('invoice_details')->select(DB::raw('day(created_at) as day'),
                        DB::raw('month(created_at) as month'),
                        DB::raw("count(invoice_details.id) as `count`"))
                        ->where(DB::raw('date(created_at)'), '>=', $lastWeek)
                        ->where(DB::raw('date(created_at)'), '<=', $today)
                        ->groupBy('month', 'day')
                        ->get();

                    // dynamically create range of month/day pairs using carbon

                    for ($i = 0; $i <= 6; $i++) {
                        $labels[intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('m')) . '/' .intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d'))] = 0;
                    }

                    $labels= array_keys($labels);

                    for ($i = 0; $i <= 6; $i++) {
                        $values[intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d'))] = 0;
                    }

                    //assign each day counts to values


                    foreach($rows as $row){

                        $values [$row->day] = $row->count;
                    }


                    $values = array_values($values);

                    $data['data'] = compact('labels', 'values');

                    return response()->json($data);

                    break;

                case '30days' :

                    $today = \Carbon\Carbon::now()->toDateString();
                    $lastWeek = \Carbon\Carbon::parse('-29 days')->toDateString();

                    $rows = DB::table('invoice_details')->select(DB::raw('day(created_at) as day'),
                        DB::raw('month(created_at) as month'),
                        DB::raw("count(invoice_details.id) as `count`"))
                        ->where(DB::raw('date(created_at)'), '>=', $lastWeek)
                        ->where(DB::raw('date(created_at)'), '<=', $today)
                        ->groupBy('month', 'day')
                        ->get();


                    // dynamically create range of month/day pairs using carbon

                    for ($i = 0; $i <= 29; $i++) {
                        $labels[intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('m')) . '/' .intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d'))] = 0;
                    }

                    $labels= array_keys($labels);

                    // build values array

                    for ($i = 0; $i <= 29; $i++) {
                        $values[intval(\Carbon\Carbon::parse("$lastWeek + $i day")->format('d'))] = 0;
                    }

                    //assign each day counts to values

                    foreach($rows as $row){

                        $values [$row->day] = $row->count;
                    }

                    $values = array_values($values);

                    $data['data'] = compact('labels', 'values');

                    return response()->json($data);

                    break;


            }


        }

        // set first and last date

        $currentYear = \Carbon\Carbon::now()->toDateString();
        $lastYear = \Carbon\Carbon::parse('first day of -11 month')->toDateString();

        $rows = DB::table('invoice_details')->select(DB::raw('Year(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw("count(invoice_details.id) as `count`"))
            ->where(DB::raw('date(created_at)'), '>=', $lastYear)
            ->where(DB::raw('date(created_at)'), '<=', $currentYear)
            ->groupBy('year', 'month')
            ->get();

        // dynamically create range of month/value pairs using carbon

        $values[intval(\Carbon\Carbon::parse($lastYear)->format('m'))] = 0;

        for ($i = 0; $i <= 11; $i++) {
            $values[intval(\Carbon\Carbon::parse("$lastYear + $i month")->format('m'))] = 0;
        }

        $months = [1 => 'Jan', 2 => 'Feb', 3 =>'Mar', 4 => 'Apr', 5 => 'May',
                   6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct',
                   11 => 'Nov', 12 => 'Dec'];

        //replace keys in values where key in months matches key in values with value in months of matching key

        $newValues = [];

       foreach($values as $monthNumber => $count){

           $key = $months[$monthNumber];
           $newValues[$key] = $count;


       }

        $labels= array_keys($newValues);


        foreach($rows as $row){

            //overwrite values into values array

            $values [$row->month] = $row->count;
        }

        $values = array_values($values);


        $currentYear = \Carbon\Carbon::parse($currentYear)->format('y');
        $lastYear = \Carbon\Carbon::parse($lastYear)->format('y');


        $data['data'] = compact('labels', 'values', 'currentYear', 'lastYear');

        return response()->json($data);



    }

    // End InvoiceDetail Chart Api Method


    // Begin InvoiceDetail Api Methods

    public function invoiceDetailData(){

        $result['data'] = DB::table('invoice_details')
                         ->select('id as Id',
                                  'invoice_detail_name as Name',
                                  'created_at as Created')
                         ->get();

        return json_encode($result);

    }

    public function invoiceDetailVueData(Request $request){

        $column = 'id';
        $direction = 'asc';

        if ($request->has('column')){

            $column = $request->get('column');
            if ($column == 'Id'){
                $direction = $request->get('direction') == 1 ? 'asc' : 'desc';
            } else {

                $direction = $request->get('direction') == 1 ? 'desc' : 'asc';
            }


        }

        if ($request->has('keyword')){

            $keyword = $request->get('keyword');

            $invoiceDetails = DB::table('invoice_details')
                ->select('id as Id',
                    'invoice_detail_name as Name',
                    'created_at as Created')
                ->where('invoice_detail_name', 'like', '%' . $keyword . '%')
                ->orderBy($column, $direction)
                ->paginate(10);

            return response()->json($invoiceDetails);



        }

        $invoiceDetails = DB::table('invoice_details')
                             ->select('id as Id',
                                      'invoice_detail_name as Name',
                                      'created_at as Created')
                             ->orderBy($column, $direction)
                             ->paginate(10);

        return response()->json($invoiceDetails);

    }

    // End InvoiceDetail Api Methods


}
