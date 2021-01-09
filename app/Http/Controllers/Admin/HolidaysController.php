<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Holiday as Holiday;
Use \Carbon\Carbon;
use Validator;


class HolidaysController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $holidays = Holiday::orderBy('Holiday_end', 'DESC')->paginate(8);

        foreach($holidays as $holiday)
        {
        $holiday->Holiday_start = date("Y-m-d H:i", strtotime($holiday['Holiday_start']));
        $holiday->Holiday_end = date("Y-m-d H:i", strtotime($holiday['Holiday_end']));
        }

        return view('admin.holidays.index', compact('holidays'));
    }

    public function create()
    {
        $CarbonTimeAndDate = Carbon::today();

        $NextDate = Carbon::today()->addDays(1);

        return view('admin.holidays.create', compact('CarbonTimeAndDate', 'NextDate'));
    }

    public function store(Request $request)
    {

        $validatedrequest = $request->validate([
            'Holiday_start_date' => ['required', 'date'],
            'Holiday_start_time' => ['required', 'date_format:H:i'],
            'Holiday_end_date' => ['required', 'date'],
            'Holiday_end_time' => ['required', 'date_format:H:i'],
        ]);

        //Checks whether booking conflicts with others
        $datestart = $request->input('Holiday_start_date');
        $dateend = $request->input('Holiday_end_date');

        $timestart = $request->input('Holiday_start_time');
        $timeend = $request->input('Holiday_end_time');

        if($timestart == "00:00" || $timestart == "00:30" || $timestart == "01:00" || $timestart == "01:30" || $timestart == "02:00" || $timestart == "02:30" || $timestart == "03:00" || $timestart == "03:30" || $timestart == "04:00" || $timestart == "04:30" || $timestart == "05:00" || $timestart == "05:30" || $timestart == "06:00" || $timestart == "06:30" || $timestart == "07:00" || $timestart == "07:30" || $timestart == "08:00" || $timestart == "08:30" || $timestart == "09:00" || $timestart == "09:30" || $timestart == "10:00" || $timestart == "10:30" || $timestart == "11:00" || $timestart == "11:30" || $timestart == "12:00" || $timestart == "12:30" || $timestart == "13:00" || $timestart == "13:30" || $timestart == "14:00" || $timestart == "14:30" || $timestart == "15:00" || $timestart == "15:30" || $timestart == "16:00" || $timestart == "16:30" || $timestart == "17:00" || $timestart == "17:30" || $timestart == "18:00" || $timestart == "18:30" || $timestart == "19:00" || $timestart == "19:30" || $timestart == "20:00" || $timestart == "20:30" || $timestart == "21:00" || $timestart == "21:30" || $timestart == "22:00" || $timestart == "22:30" || $timestart == "23:00" || $timestart == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your 'Start time' form entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($timeend == "00:00" || $timeend == "00:30" || $timeend == "01:00" || $timeend == "01:30" || $timeend == "02:00" || $timeend == "02:30" || $timeend == "03:00" || $timeend == "03:30" || $timeend == "04:00" || $timeend == "04:30" || $timeend == "05:00" || $timeend == "05:30" || $timeend == "06:00" || $timeend == "06:30" || $timeend == "07:00" || $timeend == "07:30" || $timeend == "08:00" || $timeend == "08:30" || $timeend == "09:00" || $timeend == "09:30" || $timeend == "10:00" || $timeend == "10:30" || $timeend == "11:00" || $timeend == "11:30" || $timeend == "12:00" || $timeend == "12:30" || $timeend == "13:00" || $timeend == "13:30" || $timeend == "14:00" || $timeend == "14:30" || $timeend == "15:00" || $timeend == "15:30" || $timeend == "16:00" || $timeend == "16:30" || $timeend == "17:00" || $timeend == "17:30" || $timeend == "18:00" || $timeend == "18:30" || $timeend == "19:00" || $timeend == "19:30" || $timeend == "20:00" || $timeend == "20:30" || $timeend == "21:00" || $timeend == "21:30" || $timeend == "22:00" || $timeend == "22:30" || $timeend == "23:00" || $timeend == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your 'End time' form entry. It must be either on the hour, or 30 mins past the hour.");
        }


        $time = strtotime($timestart);      //1595851260
        $time = $time + (1 * 60);
        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));

        $time = strtotime($timeend);
        $time = $time - (1 * 60);
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));

        $beginstring = "$datestart $timestart";
        $endstring = "$dateend $timeend";

        //Input validation
        if($datestart < $dateend ){
            $validatedrequest = $request->validate([
                'Holiday_start_date' => ['required', 'date'],
                'Holiday_start_time' => ['required', 'date_format:H:i'],
                'Holiday_end_date' => ['required', 'date', 'after_or_equal:Holiday_start_date'],
                'Holiday_end_time' => ['required', 'date_format:H:i'],
                'Holiday_title' => ['required', 'string', 'min:0'],
            ]);
        }
        else{
            $validatedrequest = $request->validate([
                'Holiday_start_date' => ['required', 'date'],
                'Holiday_start_time' => ['required', 'date_format:H:i'],
                'Holiday_end_date' => ['required', 'date', 'after_or_equal:Holiday_start_date'],
                'Holiday_end_time' => ['required', 'date_format:H:i', 'after:Holiday_start_time'],
                'Holiday_title' => ['required', 'string', 'min:0'],
            ]);
        }

        //Determines timecost of booking
        $startDate = strtotime($request->input('Holiday_start_date'));
        $startTime = strtotime($request->input('Holiday_start_time'));
        $endDate = strtotime($request->input('Holiday_end_date'));
        $endTime = strtotime($request->input('Holiday_end_time'));

        $start = $startDate + $startTime;
        $end2 = $endDate + $endTime;

        $Difference = $end2 - $start;
        $Hours = $Difference / 3600;

        $bookingtodatabase = [];
        $bookingtodatabase['Holiday_start'] = $beginstring;
        $bookingtodatabase['Holiday_end'] = $endstring;
        $bookingtodatabase['Holiday_title'] = $request->input('Holiday_title');

        Holiday::create($bookingtodatabase);

        return redirect()->route('admin.holidays.index');

    }

    public function edit(Holiday $holiday)
    {
        $CarbonTimeAndDate = Carbon::now('Europe/London');
        $holiday->Holiday_start = date("Y-m-d H:i", strtotime($holiday['Holiday_start']));
        $holiday->Holiday_end = date("Y-m-d H:i", strtotime($holiday['Holiday_end']));

        return view('admin.holidays.edit', compact('holiday', 'CarbonTimeAndDate'));
    }

    public function update(Request $request, Holiday $holiday)
    {
        $validatedrequest = $request->validate([
            'Holiday_start_date' => ['required', 'date'],
            'Holiday_start_time' => ['required', 'date_format:H:i'],
            'Holiday_end_date' => ['required', 'date'],
            'Holiday_end_time' => ['required', 'date_format:H:i'],
        ]);

        //Checks whether booking conflicts with others
        $datestart = $request->Holiday_start_date;
        $dateend = $request->Holiday_end_date;
        $timestart = $request->Holiday_start_time;
        $timeend = $request->Holiday_end_time;

        if($timestart == "00:00" || $timestart == "00:30" || $timestart == "01:00" || $timestart == "01:30" || $timestart == "02:00" || $timestart == "02:30" || $timestart == "03:00" || $timestart == "03:30" || $timestart == "04:00" || $timestart == "04:30" || $timestart == "05:00" || $timestart == "05:30" || $timestart == "06:00" || $timestart == "06:30" || $timestart == "07:00" || $timestart == "07:30" || $timestart == "08:00" || $timestart == "08:30" || $timestart == "09:00" || $timestart == "09:30" || $timestart == "10:00" || $timestart == "10:30" || $timestart == "11:00" || $timestart == "11:30" || $timestart == "12:00" || $timestart == "12:30" || $timestart == "13:00" || $timestart == "13:30" || $timestart == "14:00" || $timestart == "14:30" || $timestart == "15:00" || $timestart == "15:30" || $timestart == "16:00" || $timestart == "16:30" || $timestart == "17:00" || $timestart == "17:30" || $timestart == "18:00" || $timestart == "18:30" || $timestart == "19:00" || $timestart == "19:30" || $timestart == "20:00" || $timestart == "20:30" || $timestart == "21:00" || $timestart == "21:30" || $timestart == "22:00" || $timestart == "22:30" || $timestart == "23:00" || $timestart == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your 'Start time' form entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($timeend == "00:00" || $timeend == "00:30" || $timeend == "01:00" || $timeend == "01:30" || $timeend == "02:00" || $timeend == "02:30" || $timeend == "03:00" || $timeend == "03:30" || $timeend == "04:00" || $timeend == "04:30" || $timeend == "05:00" || $timeend == "05:30" || $timeend == "06:00" || $timeend == "06:30" || $timeend == "07:00" || $timeend == "07:30" || $timeend == "08:00" || $timeend == "08:30" || $timeend == "09:00" || $timeend == "09:30" || $timeend == "10:00" || $timeend == "10:30" || $timeend == "11:00" || $timeend == "11:30" || $timeend == "12:00" || $timeend == "12:30" || $timeend == "13:00" || $timeend == "13:30" || $timeend == "14:00" || $timeend == "14:30" || $timeend == "15:00" || $timeend == "15:30" || $timeend == "16:00" || $timeend == "16:30" || $timeend == "17:00" || $timeend == "17:30" || $timeend == "18:00" || $timeend == "18:30" || $timeend == "19:00" || $timeend == "19:30" || $timeend == "20:00" || $timeend == "20:30" || $timeend == "21:00" || $timeend == "21:30" || $timeend == "22:00" || $timeend == "22:30" || $timeend == "23:00" || $timeend == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your 'End time' form entry. It must be either on the hour, or 30 mins past the hour.");
        }

        $time = strtotime($timestart);
        $time = $time + (1 * 60);
        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));

        $time = strtotime($timeend);
        $time = $time - (1 * 60);
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));

        $beginstring = "$datestart $timestart";
        $endstring = "$dateend $timeend";

        // dd($request);
        //Input validation
        if($datestart < $dateend ){
            $validatedrequest = $request->validate([
                'Holiday_start_date' => ['required', 'date'],
                'Holiday_start_time' => ['required', 'date_format:H:i'],
                'Holiday_end_date' => ['required', 'date', 'after_or_equal:Holiday_start_date'],
                'Holiday_end_time' => ['required', 'date_format:H:i'],
                'Holiday_title' => ['required', 'string', 'min:0'],
            ]);
        }
        else{
            $validatedrequest = $request->validate([
                'Holiday_start_date' => ['required', 'date'],
                'Holiday_start_time' => ['required', 'date_format:H:i'],
                'Holiday_end_date' => ['required', 'date', 'after_or_equal:Holiday_start_date'],
                'Holiday_end_time' => ['required', 'date_format:H:i', 'after:Holiday_start_time'],
                'Holiday_title' => ['required', 'string', 'min:0'],
            ]);
        }

        //Determines timecost of booking
        $start = strtotime($holiday->Holiday_start);
        $end2 = strtotime($holiday->Holiday_end);

        $Difference = $end2 - $start;
        $Hours = $Difference / 3600;

        $holiday->Holiday_start = $beginstring;
        $holiday->Holiday_end = $endstring;
        $holiday->Holiday_title = $request->Holiday_title;
        $holiday->save();


        return redirect()->route('admin.holidays.index');

    }

    public function show(Holiday $holiday)
    {
        $CarbonTimeAndDate = Carbon::now('Europe/London');

        return view('admin.holidays.show', compact('holiday', 'CarbonTimeAndDate'));
    }

    public function destroy(Holiday $holiday)
    {
        //
        $holiday->delete();

        return redirect()->route('admin.holidays.index');
    }
}
