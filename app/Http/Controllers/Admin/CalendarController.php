<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Room;
use App\Booking;
use App\Holiday;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // The admin calendars index.

        // // some info to the view.
        // $CarbonTimeAndDate = Carbon::now('Europe/London');

        $allrooms = Room::all(); // Required to display links across the bottom.
        $selectedroom = Room::all();

        // $selectedroomsbookings = Booking::all()->sortBy('Booking_start');
        // $users = User::all();

        return view('admin.calendar.index', compact('allrooms', 'selectedroom'));
    }

    public function events(){

        // Gets all the bookings and holidays, ready to display to the calendar as JSON.

        $selectedroomsbookings = Booking::all()->sortBy('Booking_start');
        $scheduledholidays = Holiday::all();

        // Iterates through the collected content and creates calendar events.
        foreach($selectedroomsbookings as $item){
            // Will show as booked... this was incase someone manages to access the calendars data stream.
            $newItem["title"] = "BOOKED";
            // Unless you are a Admin.
            if(Gate::allows('manage-users')){
                // It'll show you more info.
                $newItem["title"] = $item->User->name . ", from : " . $item->User->band  . ", in : ". $item->Room->roomname . ". ";
                if($item->Equip->guitarheadamount > 0){

                    $guitarhead = "GtrHead=" . $item->Equip->guitarheadamount . ", ";
                    $newItem["title"] .= $guitarhead;
                }
                if($item->Equip->guitarcabamount > 0){

                    $guitarcab = "GtrCab=" . $item->Equip->guitarcabamount . ", ";
                    $newItem["title"] .= $guitarcab;
                }
                if($item->Equip->guitarcomboamount > 0){

                    $guitarcombo = "GtrComb=" . $item->Equip->guitarcomboamount . ", ";
                    $newItem["title"] .= $guitarcombo;
                }
                if($item->Equip->bassheadamount > 0){

                    $basshead = "BassHead=" . $item->Equip->bassheadamount . ", ";
                    $newItem["title"] .= $basshead;
                }
                if($item->Equip->basscabamount > 0){

                    $basscab = "BassCab=" . $item->Equip->basscabamount . ", ";
                    $newItem["title"] .= $basscab;
                }
                if($item->Equip->basscomboamount > 0){

                    $basscombo = "BassComb=" . $item->Equip->basscomboamount . ", ";
                    $newItem["title"] .= $basscombo;
                }
                if($item->Equip->drumkitamount > 0){

                    $drumkit = "Drums=" . $item->Equip->drumkitamount . ", ";
                    $newItem["title"] .= $drumkit;
                }
                if($item->Equip->cymbalsamount > 0){

                    $cymbals = "Cyms=" . $item->Equip->cymbalsamount . ", ";
                    $newItem["title"] .= $cymbals;
                }
            }
            // start and end is always required.
            $newItem["start"] = $item->Booking_start;
            $newItem["end"] = $item->Booking_end;

            // If your the booking is yours, Dark Purple. If not, Light purple.
            if(auth()->user()->id === $item->User->id){
                $newItem["color"] = '#6b5de8'; //#6b5de8 Dark Purple
            }
            else{
                $newItem["color"] = '#a49de3'; //#a49de3 light purple
            }
            $newArr[] = $newItem;
        }

        foreach($scheduledholidays as $holiday){
            $newItem["title"] = $holiday->Holiday_title;
            $newItem["start"] = $holiday->Holiday_start;
            $newItem["end"] = $holiday->Holiday_end;
            $newItem["color"] = 'black';
            $newArr[] = $newItem;
        }

        // Encode the formatting in a specific format before passing it to the calendar.

        $calendar = json_encode($newArr);

        return response($calendar);

      }
}

