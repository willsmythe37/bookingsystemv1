<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room as Room;

use App\Holiday as Holiday;
use App\Booking as Booking;
use App\Weblink as Weblink;
use App\SiteContent;
use Auth;

use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

Use \Carbon\Carbon;


class RoomController extends Controller
{
    /**
     * Show the room page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function rooms()
    {
        $sitecontent = SiteContent::where('pagename', 'Rooms available')->first();

        $rooms = Room::orderBy('roomname', 'ASC')
            ->get(); // To get all the rooms from the database and return them to the view.
        return view('room', compact('rooms', 'sitecontent'));
    }

    public function bookinginfo()
    {
        $sitecontent = SiteContent::where('pagename', 'Booking info')->first();
        return view('bookinginfo', compact('sitecontent'));
    }

    public function aboutus()
    {
        $weblinks = Weblink::all()->sortby('order');
        $sitecontent = SiteContent::where('pagename', 'About us')->first();
        return view('aboutus', compact('sitecontent', 'weblinks'));
    }

    public function howtofindus()
    {
        $sitecontent = SiteContent::where('pagename', 'How to find us')->first();
        return view('howtofindus', compact('sitecontent'));
    }

    public function termsandconditions()
    {
        $sitecontent = SiteContent::where('pagename', 'Terms and conditions')->first();
        return view('termsandconditions', compact('sitecontent'));
    }

    public function sitemap()
    {
        $sitecontent = SiteContent::where('pagename', 'Site map')->first();
        return view('sitemap', compact('sitecontent'));
    }

    public function privacypolicy()
    {
        $sitecontent = SiteContent::where('pagename', 'Privacy policy')->first();
        return view('privacypolicy', compact('sitecontent'));
    }

    public function cookiepolicy()
    {
        $sitecontent = SiteContent::where('pagename', 'Cookie policy')->first();
        return view('cookiepolicy', compact('sitecontent'));
    }

    public function booking(Room $room)
    {


        $CarbonTimeAndDate = Carbon::now('Europe/London');
        $allrooms = Room::all();
        $selectedroom = Room::find($room->id);

        $selectedroomsbookings = Booking::all()->where('Room_id', '=', $room->id)->sortBy('Booking_start_time')->sortBy('Booking_start_date');

        return view('booking', compact('allrooms', 'selectedroom', 'selectedroomsbookings', 'CarbonTimeAndDate',));
    }

    public function events(Room $room){

        $selectedroomsbookings = Booking::all()->where('Room_id', '=', $room->id)
                                                ->sortBy('Booking_start_time')
                                                ->sortBy('Booking_start_date');
        $scheduledholidays = Holiday::all();

        foreach($selectedroomsbookings as $item){
            $newItem["title"] = "BOOKED";
            if(Gate::allows('manage-users') || (auth()->user()->id == $item->User->id)){
                $newItem["title"] = $item->User->name . ", from : " . $item->User->band . ", in : ". $item->Room->roomname . ", ";

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
            $newItem["start"] = $item->Booking_start;
            $newItem["end"] = $item->Booking_end;
            if(auth()->user()->id === $item->User->id){
                $newItem["color"] = '#6b5de8'; //#a49de3 light purple  #6b5de8 Dark Purple
            }
            else{
                $newItem["color"] = '#a49de3'; //#a49de3 light purple  #6b5de8 Dark Purple
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

        $calendar = json_encode($newArr);
        return response($calendar);

      }



}
