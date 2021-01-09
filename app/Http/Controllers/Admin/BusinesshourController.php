<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\BusinessHour as BusinessHour;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class BusinessHourController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessHour $businesshour)
    {
        // Currently used business hours object is passed in as an object.

        // Although you'd think this code isn't required. There was an issue with validation when passing the object straight through.

        $businesshour->Mondaystart = date("H:i", strtotime($businesshour['Mondaystart']));
        $businesshour->Mondayend = date("H:i", strtotime($businesshour['Mondayend']));
        $businesshour->Tuesdaystart = date("H:i", strtotime($businesshour['Tuesdaystart']));
        $businesshour->Tuesdayend = date("H:i", strtotime($businesshour['Tuesdayend']));
        $businesshour->Wednesdaystart = date("H:i", strtotime($businesshour['Wednesdaystart']));
        $businesshour->Wednesdayend = date("H:i", strtotime($businesshour['Wednesdayend']));
        $businesshour->Thursdaystart = date("H:i", strtotime($businesshour['Thursdaystart']));
        $businesshour->Thursdayend = date("H:i", strtotime($businesshour['Thursdayend']));
        $businesshour->Fridaystart = date("H:i", strtotime($businesshour['Fridaystart']));
        $businesshour->Fridayend = date("H:i", strtotime($businesshour['Fridayend']));
        $businesshour->Saturdaystart = date("H:i", strtotime($businesshour['Saturdaystart']));
        $businesshour->Saturdayend = date("H:i", strtotime($businesshour['Saturdayend']));
        $businesshour->Sundaystart = date("H:i", strtotime($businesshour['Sundaystart']));
        $businesshour->Sundayend = date("H:i", strtotime($businesshour['Sundayend']));


        return view('admin.businesshour.edit', compact('businesshour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessHour $businesshour)
    {
        // Validates the inputs before processing.

        $validatedrequest = $request->validate([
            'Mondaystart' => ['required', 'date_format:H:i'],
            'Mondayend' => ['required', 'date_format:H:i', 'after:Mondaystart'],
            'Tuesdaystart' => ['required', 'date_format:H:i'],
            'Tuesdayend' => ['required', 'date_format:H:i', 'after:Tuesdaystart'],
            'Wednesdaystart' => ['required', 'date_format:H:i'],
            'Wednesdayend' => ['required', 'date_format:H:i', 'after:Wednesdaystart'],
            'Thursdaystart' => ['required', 'date_format:H:i'],
            'Thursdayend' => ['required', 'date_format:H:i', 'after:Thursdaystart'],
            'Fridaystart' => ['required', 'date_format:H:i'],
            'Fridayend' => ['required', 'date_format:H:i', 'after:Fridaystart'],
            'Saturdaystart' => ['required', 'date_format:H:i'],
            'Saturdayend' => ['required', 'date_format:H:i', 'after:Saturdaystart'],
            'Sundaystart' => ['required', 'date_format:H:i'],
            'Sundayend' => ['required', 'date_format:H:i'],
        ]);

        if($request->Mondaystart == "00:00" || $request->Mondaystart == "00:30" || $request->Mondaystart == "01:00" || $request->Mondaystart == "01:30" || $request->Mondaystart == "02:00" || $request->Mondaystart == "02:30" || $request->Mondaystart == "03:00" || $request->Mondaystart == "03:30" || $request->Mondaystart == "04:00" || $request->Mondaystart == "04:30" || $request->Mondaystart == "05:00" || $request->Mondaystart == "05:30" || $request->Mondaystart == "06:00" || $request->Mondaystart == "06:30" || $request->Mondaystart == "07:00" || $request->Mondaystart == "07:30" || $request->Mondaystart == "08:00" || $request->Mondaystart == "08:30" || $request->Mondaystart == "09:00" || $request->Mondaystart == "09:30" || $request->Mondaystart == "10:00" || $request->Mondaystart == "10:30" || $request->Mondaystart == "11:00" || $request->Mondaystart == "11:30" || $request->Mondaystart == "12:00" || $request->Mondaystart == "12:30" || $request->Mondaystart == "13:00" || $request->Mondaystart == "13:30" || $request->Mondaystart == "14:00" || $request->Mondaystart == "14:30" || $request->Mondaystart == "15:00" || $request->Mondaystart == "15:30" || $request->Mondaystart == "16:00" || $request->Mondaystart == "16:30" || $request->Mondaystart == "17:00" || $request->Mondaystart == "17:30" || $request->Mondaystart == "18:00" || $request->Mondaystart == "18:30" || $request->Mondaystart == "19:00" || $request->Mondaystart == "19:30" || $request->Mondaystart == "20:00" || $request->Mondaystart == "20:30" || $request->Mondaystart == "21:00" || $request->Mondaystart == "21:30" || $request->Mondaystart == "22:00" || $request->Mondaystart == "22:30" || $request->Mondaystart == "23:00" || $request->Mondaystart == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Mondaystart time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Mondayend == "00:00" || $request->Mondayend == "00:30" || $request->Mondayend == "01:00" || $request->Mondayend == "01:30" || $request->Mondayend == "02:00" || $request->Mondayend == "02:30" || $request->Mondayend == "03:00" || $request->Mondayend == "03:30" || $request->Mondayend == "04:00" || $request->Mondayend == "04:30" || $request->Mondayend == "05:00" || $request->Mondayend == "05:30" || $request->Mondayend == "06:00" || $request->Mondayend == "06:30" || $request->Mondayend == "07:00" || $request->Mondayend == "07:30" || $request->Mondayend == "08:00" || $request->Mondayend == "08:30" || $request->Mondayend == "09:00" || $request->Mondayend == "09:30" || $request->Mondayend == "10:00" || $request->Mondayend == "10:30" || $request->Mondayend == "11:00" || $request->Mondayend == "11:30" || $request->Mondayend == "12:00" || $request->Mondayend == "12:30" || $request->Mondayend == "13:00" || $request->Mondayend == "13:30" || $request->Mondayend == "14:00" || $request->Mondayend == "14:30" || $request->Mondayend == "15:00" || $request->Mondayend == "15:30" || $request->Mondayend == "16:00" || $request->Mondayend == "16:30" || $request->Mondayend == "17:00" || $request->Mondayend == "17:30" || $request->Mondayend == "18:00" || $request->Mondayend == "18:30" || $request->Mondayend == "19:00" || $request->Mondayend == "19:30" || $request->Mondayend == "20:00" || $request->Mondayend == "20:30" || $request->Mondayend == "21:00" || $request->Mondayend == "21:30" || $request->Mondayend == "22:00" || $request->Mondayend == "22:30" || $request->Mondayend == "23:00" || $request->Mondayend == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Mondayend time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Tuesdaystart == "00:00" || $request->Tuesdaystart == "00:30" || $request->Tuesdaystart == "01:00" || $request->Tuesdaystart == "01:30" || $request->Tuesdaystart == "02:00" || $request->Tuesdaystart == "02:30" || $request->Tuesdaystart == "03:00" || $request->Tuesdaystart == "03:30" || $request->Tuesdaystart == "04:00" || $request->Tuesdaystart == "04:30" || $request->Tuesdaystart == "05:00" || $request->Tuesdaystart == "05:30" || $request->Tuesdaystart == "06:00" || $request->Tuesdaystart == "06:30" || $request->Tuesdaystart == "07:00" || $request->Tuesdaystart == "07:30" || $request->Tuesdaystart == "08:00" || $request->Tuesdaystart == "08:30" || $request->Tuesdaystart == "09:00" || $request->Tuesdaystart == "09:30" || $request->Tuesdaystart == "10:00" || $request->Tuesdaystart == "10:30" || $request->Tuesdaystart == "11:00" || $request->Tuesdaystart == "11:30" || $request->Tuesdaystart == "12:00" || $request->Tuesdaystart == "12:30" || $request->Tuesdaystart == "13:00" || $request->Tuesdaystart == "13:30" || $request->Tuesdaystart == "14:00" || $request->Tuesdaystart == "14:30" || $request->Tuesdaystart == "15:00" || $request->Tuesdaystart == "15:30" || $request->Tuesdaystart == "16:00" || $request->Tuesdaystart == "16:30" || $request->Tuesdaystart == "17:00" || $request->Tuesdaystart == "17:30" || $request->Tuesdaystart == "18:00" || $request->Tuesdaystart == "18:30" || $request->Tuesdaystart == "19:00" || $request->Tuesdaystart == "19:30" || $request->Tuesdaystart == "20:00" || $request->Tuesdaystart == "20:30" || $request->Tuesdaystart == "21:00" || $request->Tuesdaystart == "21:30" || $request->Tuesdaystart == "22:00" || $request->Tuesdaystart == "22:30" || $request->Tuesdaystart == "23:00" || $request->Tuesdaystart == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Tuesdaystart time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Tuesdayend == "00:00" || $request->Tuesdayend == "00:30" || $request->Tuesdayend == "01:00" || $request->Tuesdayend == "01:30" || $request->Tuesdayend == "02:00" || $request->Tuesdayend == "02:30" || $request->Tuesdayend == "03:00" || $request->Tuesdayend == "03:30" || $request->Tuesdayend == "04:00" || $request->Tuesdayend == "04:30" || $request->Tuesdayend == "05:00" || $request->Tuesdayend == "05:30" || $request->Tuesdayend == "06:00" || $request->Tuesdayend == "06:30" || $request->Tuesdayend == "07:00" || $request->Tuesdayend == "07:30" || $request->Tuesdayend == "08:00" || $request->Tuesdayend == "08:30" || $request->Tuesdayend == "09:00" || $request->Tuesdayend == "09:30" || $request->Tuesdayend == "10:00" || $request->Tuesdayend == "10:30" || $request->Tuesdayend == "11:00" || $request->Tuesdayend == "11:30" || $request->Tuesdayend == "12:00" || $request->Tuesdayend == "12:30" || $request->Tuesdayend == "13:00" || $request->Tuesdayend == "13:30" || $request->Tuesdayend == "14:00" || $request->Tuesdayend == "14:30" || $request->Tuesdayend == "15:00" || $request->Tuesdayend == "15:30" || $request->Tuesdayend == "16:00" || $request->Tuesdayend == "16:30" || $request->Tuesdayend == "17:00" || $request->Tuesdayend == "17:30" || $request->Tuesdayend == "18:00" || $request->Tuesdayend == "18:30" || $request->Tuesdayend == "19:00" || $request->Tuesdayend == "19:30" || $request->Tuesdayend == "20:00" || $request->Tuesdayend == "20:30" || $request->Tuesdayend == "21:00" || $request->Tuesdayend == "21:30" || $request->Tuesdayend == "22:00" || $request->Tuesdayend == "22:30" || $request->Tuesdayend == "23:00" || $request->Tuesdayend == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Tuesdayend time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Wednesdaystart == "00:00" || $request->Wednesdaystart == "00:30" || $request->Wednesdaystart == "01:00" || $request->Wednesdaystart == "01:30" || $request->Wednesdaystart == "02:00" || $request->Wednesdaystart == "02:30" || $request->Wednesdaystart == "03:00" || $request->Wednesdaystart == "03:30" || $request->Wednesdaystart == "04:00" || $request->Wednesdaystart == "04:30" || $request->Wednesdaystart == "05:00" || $request->Wednesdaystart == "05:30" || $request->Wednesdaystart == "06:00" || $request->Wednesdaystart == "06:30" || $request->Wednesdaystart == "07:00" || $request->Wednesdaystart == "07:30" || $request->Wednesdaystart == "08:00" || $request->Wednesdaystart == "08:30" || $request->Wednesdaystart == "09:00" || $request->Wednesdaystart == "09:30" || $request->Wednesdaystart == "10:00" || $request->Wednesdaystart == "10:30" || $request->Wednesdaystart == "11:00" || $request->Wednesdaystart == "11:30" || $request->Wednesdaystart == "12:00" || $request->Wednesdaystart == "12:30" || $request->Wednesdaystart == "13:00" || $request->Wednesdaystart == "13:30" || $request->Wednesdaystart == "14:00" || $request->Wednesdaystart == "14:30" || $request->Wednesdaystart == "15:00" || $request->Wednesdaystart == "15:30" || $request->Wednesdaystart == "16:00" || $request->Wednesdaystart == "16:30" || $request->Wednesdaystart == "17:00" || $request->Wednesdaystart == "17:30" || $request->Wednesdaystart == "18:00" || $request->Wednesdaystart == "18:30" || $request->Wednesdaystart == "19:00" || $request->Wednesdaystart == "19:30" || $request->Wednesdaystart == "20:00" || $request->Wednesdaystart == "20:30" || $request->Wednesdaystart == "21:00" || $request->Wednesdaystart == "21:30" || $request->Wednesdaystart == "22:00" || $request->Wednesdaystart == "22:30" || $request->Wednesdaystart == "23:00" || $request->Wednesdaystart == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Wednesdaystart time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Wednesdayend == "00:00" || $request->Wednesdayend == "00:30" || $request->Wednesdayend == "01:00" || $request->Wednesdayend == "01:30" || $request->Wednesdayend == "02:00" || $request->Wednesdayend == "02:30" || $request->Wednesdayend == "03:00" || $request->Wednesdayend == "03:30" || $request->Wednesdayend == "04:00" || $request->Wednesdayend == "04:30" || $request->Wednesdayend == "05:00" || $request->Wednesdayend == "05:30" || $request->Wednesdayend == "06:00" || $request->Wednesdayend == "06:30" || $request->Wednesdayend == "07:00" || $request->Wednesdayend == "07:30" || $request->Wednesdayend == "08:00" || $request->Wednesdayend == "08:30" || $request->Wednesdayend == "09:00" || $request->Wednesdayend == "09:30" || $request->Wednesdayend == "10:00" || $request->Wednesdayend == "10:30" || $request->Wednesdayend == "11:00" || $request->Wednesdayend == "11:30" || $request->Wednesdayend == "12:00" || $request->Wednesdayend == "12:30" || $request->Wednesdayend == "13:00" || $request->Wednesdayend == "13:30" || $request->Wednesdayend == "14:00" || $request->Wednesdayend == "14:30" || $request->Wednesdayend == "15:00" || $request->Wednesdayend == "15:30" || $request->Wednesdayend == "16:00" || $request->Wednesdayend == "16:30" || $request->Wednesdayend == "17:00" || $request->Wednesdayend == "17:30" || $request->Wednesdayend == "18:00" || $request->Wednesdayend == "18:30" || $request->Wednesdayend == "19:00" || $request->Wednesdayend == "19:30" || $request->Wednesdayend == "20:00" || $request->Wednesdayend == "20:30" || $request->Wednesdayend == "21:00" || $request->Wednesdayend == "21:30" || $request->Wednesdayend == "22:00" || $request->Wednesdayend == "22:30" || $request->Wednesdayend == "23:00" || $request->Wednesdayend == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Wednesdayend time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Thursdaystart == "00:00" || $request->Thursdaystart == "00:30" || $request->Thursdaystart == "01:00" || $request->Thursdaystart == "01:30" || $request->Thursdaystart == "02:00" || $request->Thursdaystart == "02:30" || $request->Thursdaystart == "03:00" || $request->Thursdaystart == "03:30" || $request->Thursdaystart == "04:00" || $request->Thursdaystart == "04:30" || $request->Thursdaystart == "05:00" || $request->Thursdaystart == "05:30" || $request->Thursdaystart == "06:00" || $request->Thursdaystart == "06:30" || $request->Thursdaystart == "07:00" || $request->Thursdaystart == "07:30" || $request->Thursdaystart == "08:00" || $request->Thursdaystart == "08:30" || $request->Thursdaystart == "09:00" || $request->Thursdaystart == "09:30" || $request->Thursdaystart == "10:00" || $request->Thursdaystart == "10:30" || $request->Thursdaystart == "11:00" || $request->Thursdaystart == "11:30" || $request->Thursdaystart == "12:00" || $request->Thursdaystart == "12:30" || $request->Thursdaystart == "13:00" || $request->Thursdaystart == "13:30" || $request->Thursdaystart == "14:00" || $request->Thursdaystart == "14:30" || $request->Thursdaystart == "15:00" || $request->Thursdaystart == "15:30" || $request->Thursdaystart == "16:00" || $request->Thursdaystart == "16:30" || $request->Thursdaystart == "17:00" || $request->Thursdaystart == "17:30" || $request->Thursdaystart == "18:00" || $request->Thursdaystart == "18:30" || $request->Thursdaystart == "19:00" || $request->Thursdaystart == "19:30" || $request->Thursdaystart == "20:00" || $request->Thursdaystart == "20:30" || $request->Thursdaystart == "21:00" || $request->Thursdaystart == "21:30" || $request->Thursdaystart == "22:00" || $request->Thursdaystart == "22:30" || $request->Thursdaystart == "23:00" || $request->Thursdaystart == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Thursdaystart time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Thursdayend == "00:00" || $request->Thursdayend == "00:30" || $request->Thursdayend == "01:00" || $request->Thursdayend == "01:30" || $request->Thursdayend == "02:00" || $request->Thursdayend == "02:30" || $request->Thursdayend == "03:00" || $request->Thursdayend == "03:30" || $request->Thursdayend == "04:00" || $request->Thursdayend == "04:30" || $request->Thursdayend == "05:00" || $request->Thursdayend == "05:30" || $request->Thursdayend == "06:00" || $request->Thursdayend == "06:30" || $request->Thursdayend == "07:00" || $request->Thursdayend == "07:30" || $request->Thursdayend == "08:00" || $request->Thursdayend == "08:30" || $request->Thursdayend == "09:00" || $request->Thursdayend == "09:30" || $request->Thursdayend == "10:00" || $request->Thursdayend == "10:30" || $request->Thursdayend == "11:00" || $request->Thursdayend == "11:30" || $request->Thursdayend == "12:00" || $request->Thursdayend == "12:30" || $request->Thursdayend == "13:00" || $request->Thursdayend == "13:30" || $request->Thursdayend == "14:00" || $request->Thursdayend == "14:30" || $request->Thursdayend == "15:00" || $request->Thursdayend == "15:30" || $request->Thursdayend == "16:00" || $request->Thursdayend == "16:30" || $request->Thursdayend == "17:00" || $request->Thursdayend == "17:30" || $request->Thursdayend == "18:00" || $request->Thursdayend == "18:30" || $request->Thursdayend == "19:00" || $request->Thursdayend == "19:30" || $request->Thursdayend == "20:00" || $request->Thursdayend == "20:30" || $request->Thursdayend == "21:00" || $request->Thursdayend == "21:30" || $request->Thursdayend == "22:00" || $request->Thursdayend == "22:30" || $request->Thursdayend == "23:00" || $request->Thursdayend == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Thursdayend time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Fridaystart == "00:00" || $request->Fridaystart == "00:30" || $request->Fridaystart == "01:00" || $request->Fridaystart == "01:30" || $request->Fridaystart == "02:00" || $request->Fridaystart == "02:30" || $request->Fridaystart == "03:00" || $request->Fridaystart == "03:30" || $request->Fridaystart == "04:00" || $request->Fridaystart == "04:30" || $request->Fridaystart == "05:00" || $request->Fridaystart == "05:30" || $request->Fridaystart == "06:00" || $request->Fridaystart == "06:30" || $request->Fridaystart == "07:00" || $request->Fridaystart == "07:30" || $request->Fridaystart == "08:00" || $request->Fridaystart == "08:30" || $request->Fridaystart == "09:00" || $request->Fridaystart == "09:30" || $request->Fridaystart == "10:00" || $request->Fridaystart == "10:30" || $request->Fridaystart == "11:00" || $request->Fridaystart == "11:30" || $request->Fridaystart == "12:00" || $request->Fridaystart == "12:30" || $request->Fridaystart == "13:00" || $request->Fridaystart == "13:30" || $request->Fridaystart == "14:00" || $request->Fridaystart == "14:30" || $request->Fridaystart == "15:00" || $request->Fridaystart == "15:30" || $request->Fridaystart == "16:00" || $request->Fridaystart == "16:30" || $request->Fridaystart == "17:00" || $request->Fridaystart == "17:30" || $request->Fridaystart == "18:00" || $request->Fridaystart == "18:30" || $request->Fridaystart == "19:00" || $request->Fridaystart == "19:30" || $request->Fridaystart == "20:00" || $request->Fridaystart == "20:30" || $request->Fridaystart == "21:00" || $request->Fridaystart == "21:30" || $request->Fridaystart == "22:00" || $request->Fridaystart == "22:30" || $request->Fridaystart == "23:00" || $request->Fridaystart == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Fridaystart time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Fridayend == "00:00" || $request->Fridayend == "00:30" || $request->Fridayend == "01:00" || $request->Fridayend == "01:30" || $request->Fridayend == "02:00" || $request->Fridayend == "02:30" || $request->Fridayend == "03:00" || $request->Fridayend == "03:30" || $request->Fridayend == "04:00" || $request->Fridayend == "04:30" || $request->Fridayend == "05:00" || $request->Fridayend == "05:30" || $request->Fridayend == "06:00" || $request->Fridayend == "06:30" || $request->Fridayend == "07:00" || $request->Fridayend == "07:30" || $request->Fridayend == "08:00" || $request->Fridayend == "08:30" || $request->Fridayend == "09:00" || $request->Fridayend == "09:30" || $request->Fridayend == "10:00" || $request->Fridayend == "10:30" || $request->Fridayend == "11:00" || $request->Fridayend == "11:30" || $request->Fridayend == "12:00" || $request->Fridayend == "12:30" || $request->Fridayend == "13:00" || $request->Fridayend == "13:30" || $request->Fridayend == "14:00" || $request->Fridayend == "14:30" || $request->Fridayend == "15:00" || $request->Fridayend == "15:30" || $request->Fridayend == "16:00" || $request->Fridayend == "16:30" || $request->Fridayend == "17:00" || $request->Fridayend == "17:30" || $request->Fridayend == "18:00" || $request->Fridayend == "18:30" || $request->Fridayend == "19:00" || $request->Fridayend == "19:30" || $request->Fridayend == "20:00" || $request->Fridayend == "20:30" || $request->Fridayend == "21:00" || $request->Fridayend == "21:30" || $request->Fridayend == "22:00" || $request->Fridayend == "22:30" || $request->Fridayend == "23:00" || $request->Fridayend == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Fridayend time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Saturdaystart == "00:00" || $request->Saturdaystart == "00:30" || $request->Saturdaystart == "01:00" || $request->Saturdaystart == "01:30" || $request->Saturdaystart == "02:00" || $request->Saturdaystart == "02:30" || $request->Saturdaystart == "03:00" || $request->Saturdaystart == "03:30" || $request->Saturdaystart == "04:00" || $request->Saturdaystart == "04:30" || $request->Saturdaystart == "05:00" || $request->Saturdaystart == "05:30" || $request->Saturdaystart == "06:00" || $request->Saturdaystart == "06:30" || $request->Saturdaystart == "07:00" || $request->Saturdaystart == "07:30" || $request->Saturdaystart == "08:00" || $request->Saturdaystart == "08:30" || $request->Saturdaystart == "09:00" || $request->Saturdaystart == "09:30" || $request->Saturdaystart == "10:00" || $request->Saturdaystart == "10:30" || $request->Saturdaystart == "11:00" || $request->Saturdaystart == "11:30" || $request->Saturdaystart == "12:00" || $request->Saturdaystart == "12:30" || $request->Saturdaystart == "13:00" || $request->Saturdaystart == "13:30" || $request->Saturdaystart == "14:00" || $request->Saturdaystart == "14:30" || $request->Saturdaystart == "15:00" || $request->Saturdaystart == "15:30" || $request->Saturdaystart == "16:00" || $request->Saturdaystart == "16:30" || $request->Saturdaystart == "17:00" || $request->Saturdaystart == "17:30" || $request->Saturdaystart == "18:00" || $request->Saturdaystart == "18:30" || $request->Saturdaystart == "19:00" || $request->Saturdaystart == "19:30" || $request->Saturdaystart == "20:00" || $request->Saturdaystart == "20:30" || $request->Saturdaystart == "21:00" || $request->Saturdaystart == "21:30" || $request->Saturdaystart == "22:00" || $request->Saturdaystart == "22:30" || $request->Saturdaystart == "23:00" || $request->Saturdaystart == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Saturdaystart time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Saturdayend == "00:00" || $request->Saturdayend == "00:30" || $request->Saturdayend == "01:00" || $request->Saturdayend == "01:30" || $request->Saturdayend == "02:00" || $request->Saturdayend == "02:30" || $request->Saturdayend == "03:00" || $request->Saturdayend == "03:30" || $request->Saturdayend == "04:00" || $request->Saturdayend == "04:30" || $request->Saturdayend == "05:00" || $request->Saturdayend == "05:30" || $request->Saturdayend == "06:00" || $request->Saturdayend == "06:30" || $request->Saturdayend == "07:00" || $request->Saturdayend == "07:30" || $request->Saturdayend == "08:00" || $request->Saturdayend == "08:30" || $request->Saturdayend == "09:00" || $request->Saturdayend == "09:30" || $request->Saturdayend == "10:00" || $request->Saturdayend == "10:30" || $request->Saturdayend == "11:00" || $request->Saturdayend == "11:30" || $request->Saturdayend == "12:00" || $request->Saturdayend == "12:30" || $request->Saturdayend == "13:00" || $request->Saturdayend == "13:30" || $request->Saturdayend == "14:00" || $request->Saturdayend == "14:30" || $request->Saturdayend == "15:00" || $request->Saturdayend == "15:30" || $request->Saturdayend == "16:00" || $request->Saturdayend == "16:30" || $request->Saturdayend == "17:00" || $request->Saturdayend == "17:30" || $request->Saturdayend == "18:00" || $request->Saturdayend == "18:30" || $request->Saturdayend == "19:00" || $request->Saturdayend == "19:30" || $request->Saturdayend == "20:00" || $request->Saturdayend == "20:30" || $request->Saturdayend == "21:00" || $request->Saturdayend == "21:30" || $request->Saturdayend == "22:00" || $request->Saturdayend == "22:30" || $request->Saturdayend == "23:00" || $request->Saturdayend == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Saturdayend time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Sundaystart == "00:00" || $request->Sundaystart == "00:30" || $request->Sundaystart == "01:00" || $request->Sundaystart == "01:30" || $request->Sundaystart == "02:00" || $request->Sundaystart == "02:30" || $request->Sundaystart == "03:00" || $request->Sundaystart == "03:30" || $request->Sundaystart == "04:00" || $request->Sundaystart == "04:30" || $request->Sundaystart == "05:00" || $request->Sundaystart == "05:30" || $request->Sundaystart == "06:00" || $request->Sundaystart == "06:30" || $request->Sundaystart == "07:00" || $request->Sundaystart == "07:30" || $request->Sundaystart == "08:00" || $request->Sundaystart == "08:30" || $request->Sundaystart == "09:00" || $request->Sundaystart == "09:30" || $request->Sundaystart == "10:00" || $request->Sundaystart == "10:30" || $request->Sundaystart == "11:00" || $request->Sundaystart == "11:30" || $request->Sundaystart == "12:00" || $request->Sundaystart == "12:30" || $request->Sundaystart == "13:00" || $request->Sundaystart == "13:30" || $request->Sundaystart == "14:00" || $request->Sundaystart == "14:30" || $request->Sundaystart == "15:00" || $request->Sundaystart == "15:30" || $request->Sundaystart == "16:00" || $request->Sundaystart == "16:30" || $request->Sundaystart == "17:00" || $request->Sundaystart == "17:30" || $request->Sundaystart == "18:00" || $request->Sundaystart == "18:30" || $request->Sundaystart == "19:00" || $request->Sundaystart == "19:30" || $request->Sundaystart == "20:00" || $request->Sundaystart == "20:30" || $request->Sundaystart == "21:00" || $request->Sundaystart == "21:30" || $request->Sundaystart == "22:00" || $request->Sundaystart == "22:30" || $request->Sundaystart == "23:00" || $request->Sundaystart == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Sundaystart time entry. It must be either on the hour, or 30 mins past the hour.");
        }
        if($request->Sundayend == "00:00" || $request->Sundayend == "00:30" || $request->Sundayend == "01:00" || $request->Sundayend == "01:30" || $request->Sundayend == "02:00" || $request->Sundayend == "02:30" || $request->Sundayend == "03:00" || $request->Sundayend == "03:30" || $request->Sundayend == "04:00" || $request->Sundayend == "04:30" || $request->Sundayend == "05:00" || $request->Sundayend == "05:30" || $request->Sundayend == "06:00" || $request->Sundayend == "06:30" || $request->Sundayend == "07:00" || $request->Sundayend == "07:30" || $request->Sundayend == "08:00" || $request->Sundayend == "08:30" || $request->Sundayend == "09:00" || $request->Sundayend == "09:30" || $request->Sundayend == "10:00" || $request->Sundayend == "10:30" || $request->Sundayend == "11:00" || $request->Sundayend == "11:30" || $request->Sundayend == "12:00" || $request->Sundayend == "12:30" || $request->Sundayend == "13:00" || $request->Sundayend == "13:30" || $request->Sundayend == "14:00" || $request->Sundayend == "14:30" || $request->Sundayend == "15:00" || $request->Sundayend == "15:30" || $request->Sundayend == "16:00" || $request->Sundayend == "16:30" || $request->Sundayend == "17:00" || $request->Sundayend == "17:30" || $request->Sundayend == "18:00" || $request->Sundayend == "18:30" || $request->Sundayend == "19:00" || $request->Sundayend == "19:30" || $request->Sundayend == "20:00" || $request->Sundayend == "20:30" || $request->Sundayend == "21:00" || $request->Sundayend == "21:30" || $request->Sundayend == "22:00" || $request->Sundayend == "22:30" || $request->Sundayend == "23:00" || $request->Sundayend == "23:30" ){
        }
        else{
            return redirect()->back()->withInput()->with('Booking_query_error', "There's an issue with your Sundayend time entry. It must be either on the hour, or 30 mins past the hour.");
        }



        // If successfuly, assigns and saves.
        $businesshour->Mondaystart = $request->Mondaystart;
        $businesshour->Mondayend = $request->Mondayend;
        $businesshour->Tuesdaystart = $request->Tuesdaystart;
        $businesshour->Tuesdayend = $request->Tuesdayend;
        $businesshour->Wednesdaystart = $request->Wednesdaystart;
        $businesshour->Wednesdayend = $request->Wednesdayend;
        $businesshour->Thursdaystart = $request->Thursdaystart;
        $businesshour->Thursdayend = $request->Thursdayend;
        $businesshour->Fridaystart = $request->Fridaystart;
        $businesshour->Fridayend = $request->Fridayend;
        $businesshour->Saturdaystart = $request->Saturdaystart;
        $businesshour->Saturdayend = $request->Saturdayend;
        $businesshour->Sundaystart = $request->Sundaystart;
        $businesshour->Sundayend = $request->Sundayend;
        $businesshour->save();

        return redirect()->route('home');
    }
}
