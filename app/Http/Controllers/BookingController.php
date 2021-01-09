<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Booking as Booking;
use App\Holiday as Holiday;
use App\SiteContent as SiteContent;
use App\User as User;
use App\Room as Room;
use App\Equip as Equip;
use App\HirePrice as HirePrice;
use App\History as History;
use Auth;
use App\BusinessInfo as BusinessInfo;
use App\BusinessHour as BusinessHour;
use Spatie\OpeningHours\OpeningHours;
use Spatie\OpeningHours\TimeRange;
use Spatie\OpeningHours\Time;
use DateTime;
use Illuminate\Support\Facades\Gate;

use App\Mail\BookingCreated;
use App\Mail\BookingUpdated;
use App\Mail\BookingDeleted;

Use \Carbon\Carbon;


class BookingController extends Controller
{
    // THIS IS THE MAIN BOOKING CONTROLLER UTILISED BY ADMINS AND USERS TO CREATE INITIAL BOOKINGS
    // IT IS ALSO UTILIZED BY USERS TO VIEW, UPDATE, AND CANCEL THEIR BOOKINGS.

    // ALL ACTIONS SHOULD ALSO UPDATE THE HISTORY TABLE.



    public function mybookings(User $user)
    {
        // THIS METHOD IS CALLED TO DISPLAY A USERS BOOKINGS AND DISPLAY THEM TO THE VIEW.


        // Checks that current user ID is the same as one which you're trying to view.

        if(Auth::user()->id != $user->id){
        return redirect()->route('home')->with('This is not your user account');
        }
        // Gets the Bookings.
        $mybookings = Booking::where('User_id', '=', auth()->user()->id)->orderBy('Booking_start', 'DESC')->paginate(8);

        // Gets the current time.
        $CarbonDate = Carbon::now('Europe/London');

        // Get's the Businessinfo because of the mailto: link in the HTML.
        $businessinfo = BusinessInfo::find('1');

        return view('user.bookings.index', compact('mybookings', 'businessinfo', 'CarbonDate'));
    }

    public function bookingcreated(Request $bookinginfo)
    {
        // THIS IS THE STORE METHOD UTILISED FOR ADMINS AND USERS TO CREATE BOOKINGS.
        // dd($bookinginfo);
        //------ Get's extra SiteContent.
        $sitecontent = SiteContent::where('pagename', 'Booking Created')->first();

        // Validates the time and date inputs first. This is because there are slightly different validation rules if the start date is not on the same day.
        $validatedrequest = $bookinginfo->validate([
            'Booking_start_date' => ['required', 'date'],
            'Booking_start_time' => ['required', 'date_format:H:i'],
            'Booking_end_date' => ['required', 'date'],
            'Booking_end_time' => ['required', 'date_format:H:i'],
        ]);

        //------ Assigns the user inputs for booking start and end
        $datestart = $bookinginfo->input('Booking_start_date');
        $dateend = $bookinginfo->input('Booking_end_date');

        $timestart = $bookinginfo->input('Booking_start_time');
        $timeend = $bookinginfo->input('Booking_end_time');

        // Main Input validation
        if($datestart < $dateend ){
            $validatedrequest = $bookinginfo->validate([
                'Room_id' => ['required', 'integer'],
                'User_id' => ['required', 'integer'],
                'Booking_start_date' => ['required', 'date'],
                'Booking_start_time' => ['required', 'date_format:H:i'],
                'Booking_end_date' => ['required', 'date', 'after_or_equal:Booking_start_date'],
                'Booking_end_time' => ['required', 'date_format:H:i'],
                'guitarheadamount' => ['required', 'numeric', 'min:0'],
                'guitarcabamount' => ['required', 'numeric', 'min:0'],
                'guitarcomboamount' => ['required', 'numeric', 'min:0'],
                'bassheadamount' => ['required', 'numeric', 'min:0'],
                'basscabamount' => ['required', 'numeric', 'min:0'],
                'basscomboamount' => ['required', 'numeric', 'min:0'],
                'drumkitamount' => ['required', 'numeric', 'min:0'],
                'cymbalsamount' => ['required', 'numeric', 'min:0'],
            ]);
        }
        else{
            $validatedrequest = $bookinginfo->validate([
                'Room_id' => ['required', 'integer'],
                'User_id' => ['required', 'integer'],
                'Booking_start_date' => ['required', 'date'],
                'Booking_start_time' => ['required', 'date_format:H:i'],
                'Booking_end_date' => ['required', 'date', 'after_or_equal:Booking_start_date'],
                'Booking_end_time' => ['required', 'date_format:H:i', 'after:Booking_start_time'],
                'guitarheadamount' => ['required', 'numeric', 'min:0'],
                'guitarcabamount' => ['required', 'numeric', 'min:0'],
                'guitarcomboamount' => ['required', 'numeric', 'min:0'],
                'bassheadamount' => ['required', 'numeric', 'min:0'],
                'basscabamount' => ['required', 'numeric', 'min:0'],
                'basscomboamount' => ['required', 'numeric', 'min:0'],
                'drumkitamount' => ['required', 'numeric', 'min:0'],
                'cymbalsamount' => ['required', 'numeric', 'min:0'],
            ]);
        }

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



        //------ Merges user inputs into DateTime objects
        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));

        //------ Minus a minute from one because Spatie/Businesshours is bugged.
        $rangefixedend = date("Y-m-d H:i",strtotime('-1 minute',strtotime("$dateend $timeend")));

        //------ Not sure, remove?
        $beginstring = "$datestart $timestart";
        $endstring = "$dateend $timeend";

        //------ determines if theres a timeslot conflict in chosen room
         $count = Booking::where('Room_id', $bookinginfo->Room_id)
             ->where(function ($query) use ($begin, $end) {
                 $query->where(function ($q) use ($begin, $end) {
                     $q->where('Booking_start', '>=', $begin)
                     ->where('Booking_start', '<', $end);
                 })->orWhere(function ($q) use ($begin, $end) {
                     $q->where('Booking_start', '<=', $begin)
                     ->where('Booking_end', '>', $end);
                 })->orWhere(function ($q) use ($begin, $end) {
                     $q->where('Booking_end', '>', $begin)
                     ->where('Booking_end', '<=', $end);
                 })->orWhere(function ($q) use ($begin, $end) {
                     $q->where('Booking_start', '>=', $begin)
                     ->where('Booking_end', '<=', $end);
                 });
         })->count();

         if($count != 0){
            if($count == 1){
                return redirect()->back()->withInput()->with('Booking_query_error',
                'The times ' . $timestart . ' and ' . $timeend . ' conflict with ' . $count . ' other booking');
            }
            else{
                return redirect()->back()->withInput()->with('Booking_query_error',
                'The times ' . $timestart . ' and ' . $timeend . ' conflict with ' . $count . ' other bookings');
            }
        }

        if(Gate::allows('manage-users')){

        }else{
        //------ determines if theres a timeslot conflict with a Holiday.
            $count2 = Holiday::where(function ($query) use ($begin, $end) {
                    $query->where(function ($q) use ($begin, $end) {
                        $q->where('Holiday_start', '>=', $begin)
                        ->where('Holiday_start', '<', $end);
                    })->orWhere(function ($q) use ($begin, $end) {
                        $q->where('Holiday_start', '<=', $begin)
                        ->where('Holiday_end', '>', $end);
                    })->orWhere(function ($q) use ($begin, $end) {
                        $q->where('Holiday_end', '>', $begin)
                        ->where('Holiday_end', '<=', $end);
                    })->orWhere(function ($q) use ($begin, $end) {
                        $q->where('Holiday_start', '>=', $begin)
                        ->where('Holiday_end', '<=', $end);
                    });
            })->count();

            if($count2 != 0){
                if($count2 == 1){
                    return redirect()->back()->withInput()->with('Booking_query_error',
                    'The form fields you have entered conflict with a planned business holiday.');
                }
                else{
                    return redirect()->back()->withInput()->with('Booking_query_error',
                    'The form fields you have entered conflict with a planned business holidays.');
                }
            }
        }

        //------ Aims to prevent a user from having more than 4 future bookings at a time.
        $CarbonDate = date("Y-m-d H:s", strtotime(Carbon::now('Europe/London')));
        //------ Aims to prevent a user from booking too far in advance
        $CarbonDateplus = date("Y-m-d", strtotime('+90 days',strtotime(Carbon::now('Europe/London'))));

        $userid = auth()->user()->id;
        $mybookingcount = Booking::where('User_id', '=', $userid)
                        ->where('Booking_start', '>=', $CarbonDate)
                        ->count();

        if($mybookingcount >= 4){
            if(Gate::allows('manage-users')){

            }else{
                return redirect()->back()->withInput()->with('Booking_query_error',
                'Unfortunatly, users of our system can only have 4 future bookings at any one time.');

            }
        }

        if(Gate::allows('manage-users')){

        }else{
            if($end > $CarbonDateplus)
            {
                return redirect()->back()->withInput()->with('Booking_query_error',
                'Unfortunatly, users of our system can only book 90 days into the future.');
            }
        }

        if(Gate::allows('manage-users')){

        }else{
            if($begin < $CarbonDate)
            {
            return redirect()->back()->withInput()->with('Booking_query_error',
            "Unfortunatly, the start of your booking must occur in the future. Check your 'Start date' and 'Start time'.");
            }
        }

        // Admin can operate outside of business hours
        if(Gate::allows('manage-users')){

        }else{
            //------ Gets the currently set business hours and assigns them in time format.

            $b = BusinessHour::find('1');
            $b->Mondaystart = date("H:i", strtotime($b->Mondaystart));
            $b->Mondayend = date("H:i", strtotime($b->Mondayend));
            $b->Tuesdaystart = date("H:i", strtotime($b->Tuesdaystart));
            $b->Tuesdayend = date("H:i", strtotime($b->Tuesdayend));
            $b->Wednesdaystart = date("H:i", strtotime($b->Wednesdaystart));
            $b->Wednesdayend = date("H:i", strtotime($b->Wednesdayend));
            $b->Thursdaystart = date("H:i", strtotime($b->Thursdaystart));
            $b->Thursdayend = date("H:i", strtotime($b->Thursdayend));
            $b->Fridaystart = date("H:i", strtotime($b->Fridaystart));
            $b->Fridayend = date("H:i", strtotime($b->Fridayend));
            $b->Saturdaystart = date("H:i", strtotime($b->Saturdaystart));
            $b->Saturdayend = date("H:i", strtotime($b->Saturdayend));
            $b->Sundaystart = date("H:i", strtotime($b->Sundaystart));
            $b->Sundayend = date("H:i", strtotime($b->Sundayend));

            //------ Uses them to create the Spatie/Opening hours type object to reference against.

            $openingHours = OpeningHours::create([
                'monday'     => [$b->Mondaystart . '-' . $b->Mondayend],
                'tuesday'    => [$b->Tuesdaystart . '-' . $b->Tuesdayend],
                'wednesday'  => [$b->Wednesdaystart . '-' . $b->Wednesdayend],
                'thursday'   => [$b->Thursdaystart . '-' . $b->Thursdayend],
                'friday'     => [$b->Fridaystart . '-' . $b->Fridayend],
                'saturday'   => [$b->Saturdaystart . '-' . $b->Saturdayend],
                'sunday'     => [$b->Sundaystart . '-' . $b->Sundayend],
                'exceptions' => [
                    '2016-11-11' => ['09:00-12:00'],
                    '2016-12-25' => [],
                //  '01-01'      => [],                // Recurring on each 1st of January
                //  '12-25'      => ['09:00-12:00'],   // Recurring on each 25th of December
                ],
            ]);

            //------ Feeds chosen times and dates into the Opening Hours object we created.
            //------ If it doesn't find that the business is open, it is closed.

            ///////////////////// Opening hours check

            $openinghourscheck = $begin;
            $openinghoursendcheck = date("Y-m-d H:i", strtotime('+29 minutes',strtotime($begin)));

            //---- Check stock for every 30 minute slot between the customers chosen time
            do {

                    $rangebegin = $openingHours->currentOpenRange(new DateTime($openinghourscheck));
                    $rangeend = $openingHours->currentOpenRange(new DateTime($openinghoursendcheck));

                    if($rangebegin == false){
                        return redirect()->back()->withInput()->with('Booking_query_error',
                        "Sorry, we aren't open at those times. Please check the bottom of the page for our business hours.");

                    }elseif($rangeend == false){
                        return redirect()->back()->withInput()->with('Booking_query_error',
                        "Sorry, we aren't open at those times. Please check the bottom of the page for our business hours.");
                    }

                    //---- Set the next 30 minute slot to check.
                    $openinghourscheck = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($openinghourscheck)));
                    $openinghoursendcheck = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($openinghoursendcheck)));

            } while ($openinghourscheck < $end);

        }
        ///////////////////// END OF OPENING HOURS

        //----- Determines timecost of booking (INPUTS ARE DATE AND TIME SO HAVE TO BE PROCESSED)
        $startDate = strtotime($bookinginfo->input('Booking_start_date'));
        $startTime = strtotime($bookinginfo->input('Booking_start_time'));
        $endDate = strtotime($bookinginfo->input('Booking_end_date'));
        $endTime = strtotime($bookinginfo->input('Booking_end_time'));

        $start = $startDate + $startTime;
        $end2 = $endDate + $endTime;    //Because there is $begin and $end earlier

        $Difference = $end2 - $start;
        $Hours = $Difference / 3600;

        $room = Room::find($bookinginfo->input('Room_id'));
        $CostOfBooking = $Hours * $room->priceperhour;

        //----- Gets Hire Prices and STOCK
        $currenthireprices = HirePrice::all()->first();

        //----- Assigns users form inputs
        $guitarheadamount = $bookinginfo->input('guitarheadamount');
        $guitarcabamount = $bookinginfo->input('guitarcabamount');
        $guitarcomboamount = $bookinginfo->input('guitarcomboamount');
        $bassheadamount = $bookinginfo->input('bassheadamount');
        $basscabamount = $bookinginfo->input('basscabamount');
        $basscomboamount = $bookinginfo->input('basscomboamount');
        $drumkitamount = $bookinginfo->input('drumkitamount');
        $cymbalsamount = $bookinginfo->input('cymbalsamount');

        //----- Sets counts to zero.
        $guitarheadcount = 0;
        $guitarcabcount = 0;
        $guitarcombocount = 0;
        $bassheadcount = 0;
        $basscabcount = 0;
        $basscombocount = 0;
        $drumkitcount = 0;
        $cymbalscount = 0;



        //---- STOCK CHECK TIME

        //---- Creates and defines the starting points for stock checks.
        $stockcheckbegin = $begin;
        $stockcheckend = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($begin)));

        $tempguitarheadcount = 0;
        $tempguitarcabcount = 0;
        $tempguitarcombocount = 0;
        $tempbassheadcount = 0;
        $tempbasscabcount = 0;
        $tempbasscombocount = 0;
        $tempdrumkitcount = 0;
        $tempcymbalscount = 0;

        //---- Check stock for every 30 minute slot between the customers chosen time
        do {
            $otherbookings = Booking::orderby('Booking_start', 'ASC')
            ->where(function ($query) use ($stockcheckbegin, $stockcheckend) {
                $query->where(function ($q) use ($stockcheckbegin, $stockcheckend) {
                    $q->where('Booking_start', '>=', $stockcheckbegin)
                    ->where('Booking_start', '<', $stockcheckend);
                })->orWhere(function ($q) use ($stockcheckbegin, $stockcheckend) {
                    $q->where('Booking_start', '<=', $stockcheckbegin)
                    ->where('Booking_end', '>', $stockcheckend);
                })->orWhere(function ($q) use ($stockcheckbegin, $stockcheckend) {
                    $q->where('Booking_end', '>', $stockcheckbegin)
                    ->where('Booking_end', '<=', $stockcheckend);
                })->orWhere(function ($q) use ($stockcheckbegin, $stockcheckend) {
                    $q->where('Booking_start', '>=', $stockcheckbegin)
                    ->where('Booking_end', '<=', $stockcheckend);
                });
            })->get();

            foreach($otherbookings as $other){

                $tempguitarheadcount = $tempguitarheadcount + $other->Equip->guitarheadamount;
                $tempguitarcabcount = $tempguitarcabcount + $other->Equip->guitarcabamount;
                $tempguitarcombocount = $tempguitarcombocount + $other->Equip->guitarcomboamount;
                $tempbassheadcount = $tempbassheadcount + $other->Equip->bassheadamount;
                $tempbasscabcount = $tempbasscabcount + $other->Equip->basscabamount;
                $tempbasscombocount = $tempbasscombocount + $other->Equip->basscomboamount;
                $tempdrumkitcount = $tempdrumkitcount + $other->Equip->drumkitamount;
                $tempcymbalscount = $tempcymbalscount + $other->Equip->cymbalsamount;

                if(($currenthireprices->guitarheadstock - ($guitarheadamount + $tempguitarheadcount)) < 0){
                    return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Guitar Head' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
                }
                if(($currenthireprices->guitarcabstock - ($guitarcabamount + $tempguitarcabcount)) < 0){
                    return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Guitar Cab' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
                }
                if(($currenthireprices->guitarcombostock - ($guitarcomboamount + $tempguitarcombocount)) < 0){
                    return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Guitar Combo' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
                }
                if(($currenthireprices->bassheadstock - ($bassheadamount + $tempbassheadcount)) < 0){
                    return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Bass Head' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
                }
                if(($currenthireprices->basscabstock - ($basscabamount + $tempbasscabcount)) < 0){
                    return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Bass Cab' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
                }
                if(($currenthireprices->basscombostock - ($basscomboamount + $tempbasscombocount)) < 0){
                    return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Bass Combo' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
                }
                if(($currenthireprices->drumkitstock - ($drumkitamount + $tempdrumkitcount)) < 0){
                    return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Drum kit' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
                }
                if(($currenthireprices->cymbalsstock - ($cymbalsamount + $tempcymbalscount)) < 0){
                    return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our sets of 'Cymbals' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
                }
            }
                //---- Passed? then reset the counts.
                $tempguitarheadcount = 0;
                $tempguitarcabcount = 0;
                $tempguitarcombocount = 0;
                $tempbassheadcount = 0;
                $tempbasscabcount = 0;
                $tempbasscombocount = 0;
                $tempdrumkitcount = 0;
                $tempcymbalscount = 0;

                //---- Set the next 30 minute slot to check.
                $stockcheckbegin = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($stockcheckbegin)));
                $stockcheckend = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($stockcheckend)));

        } while ($stockcheckbegin != $end);

        //---- For when there aren't any bookings but they still want more stock then is available.
        if(($currenthireprices->guitarheadstock - ($guitarheadamount + $guitarheadcount)) < 0){
            return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $guitarheadamount guitar heads available between $timestart and $timeend. There's $currenthireprices->guitarheadstock in stock and $guitarheadcount in use.");
        }
        if(($currenthireprices->guitarcabstock - ($guitarcabamount + $guitarcabcount)) < 0){
            return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $guitarcabamount 'Guitar cabs' available between $timestart and $timeend. There's $currenthireprices->guitarcabstock in stock and $guitarcabcount in use.");
        }
        if(($currenthireprices->guitarcombostock - ($guitarcomboamount + $guitarcombocount)) < 0){
            return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $guitarcomboamount 'Guitar combos' available between $timestart and $timeend. There's $currenthireprices->guitarcombostock in stock and $guitarcombocount in use.");
        }
        if(($currenthireprices->bassheadstock - ($bassheadamount + $bassheadcount)) < 0) {
            return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $bassheadamount 'Bass heads' available between $timestart and $timeend. There's $currenthireprices->bassheadstock in stock and $bassheadcount in use.");
        }
        if(($currenthireprices->basscabstock - ($basscabamount + $basscabcount)) < 0) {
            return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $basscabamount 'Bass cabs' available between $timestart and $timeend. There's $currenthireprices->basscabstock in stock and $basscabcount in use.");
        }
        if(($currenthireprices->basscombostock - ($basscomboamount + $basscombocount)) < 0){
            return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $basscomboamount 'Bass combos' available between $timestart and $timeend. There's $currenthireprices->basscombostock in stock and $basscombocount in use.");
        }
        if(($currenthireprices->drumkitstock - ($drumkitamount + $drumkitcount)) < 0){
            return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $drumkitamount 'Drum kits' available between $timestart and $timeend. There's $currenthireprices->drumkitstock in stock and $drumkitcount in use.");
        }
        if(($currenthireprices->cymbalsstock - ($cymbalsamount + $cymbalscount)) < 0){
            return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $cymbalsamount 'sets of cymbals' available between $timestart and $timeend. There's $currenthireprices->cymbalsstock in stock and $cymbalscount in use.");
        }

        //----- Calculate prices for equipment.

        $equipmenttotal = 0;
        $equipmenttotal = $equipmenttotal + ($currenthireprices->guitarhead * $guitarheadamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->guitarcab * $guitarcabamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->guitarcombo * $guitarcomboamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->basshead * $bassheadamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->basscab * $basscabamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->basscombo * $basscomboamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->drumkit * $drumkitamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->cymbals * $cymbalsamount);
        $CostOfBooking = $CostOfBooking + $equipmenttotal;

        //---- Clear up check, SHOULD the admin make a room unavailable whilst this is running.
        if($room->available == 0){
            return redirect()->back()->with('Booking_query_error',
            "Unfortunatly booking for this space has been decomissioned for a short time. Please try one of our other spaces.");
        }
        else

        // Get's the Businessinfo because of the mailto: link in the HTML.
        $businessinfo = BusinessInfo::find('1');

        $bookingtodatabase = [];
        $bookingtodatabase['Room_id'] = $bookinginfo->input('Room_id');
        $bookingtodatabase['User_id'] = $bookinginfo->input('User_id');
        $bookingtodatabase['Booking_start'] = $beginstring;
        $bookingtodatabase['Booking_end'] = $endstring;
        $bookingtodatabase['Cost_of_booking'] = $CostOfBooking;
        $bookingtodatabase['Payment_status'] = false;
        $equiptodatabase = [];
        $equiptodatabase['guitarheadamount'] = $bookinginfo->input('guitarheadamount');
        $equiptodatabase['guitarcabamount'] = $bookinginfo->input('guitarcabamount');
        $equiptodatabase['guitarcomboamount'] = $bookinginfo->input('guitarcomboamount');
        $equiptodatabase['bassheadamount'] = $bookinginfo->input('bassheadamount');
        $equiptodatabase['basscabamount'] = $bookinginfo->input('basscabamount');
        $equiptodatabase['basscomboamount'] = $bookinginfo->input('basscomboamount');
        $equiptodatabase['drumkitamount'] = $bookinginfo->input('drumkitamount');
        $equiptodatabase['cymbalsamount'] = $bookinginfo->input('cymbalsamount');
        $equiptodatabase['equiptotal'] = $equipmenttotal;
        $bookingcomplete = Booking::create($bookingtodatabase);
        $equiptodatabase['Booking_id'] = $bookingcomplete->id;
        $equiptodatabase = Equip::create($equiptodatabase);

        $historytodatabase = [];
        $historytodatabase['Booking_id'] = $bookingcomplete->id;
        $historytodatabase['Room_id'] = $bookingtodatabase['Room_id'];
        $historytodatabase['roomname'] = $bookingcomplete->Room->roomname;
        $historytodatabase['priceperhour'] = $bookingcomplete->Room->priceperhour;
        $historytodatabase['User_id'] = $bookinginfo->input('User_id');
        $historytodatabase['name'] = $bookingcomplete->User->name;
        $historytodatabase['surname'] = $bookingcomplete->User->surname;
        $historytodatabase['band'] = $bookingcomplete->User->band;
        $historytodatabase['email'] = $bookingcomplete->User->email;
        $historytodatabase['phonenumber'] = $bookingcomplete->User->phonenumber;
        $historytodatabase['status'] = "CREATED";
        $historytodatabase['Payment_status'] = false;
        $historytodatabase['Booking_start'] = $beginstring;
        $historytodatabase['Booking_end'] = $endstring;
        $historytodatabase['Cost_of_booking'] = $CostOfBooking;
        $historytodatabase['equiptotal'] = $equipmenttotal;
        $historytodatabase['wascreated_at'] = $bookingcomplete->created_at;
        $historytodatabase['wasupdated_at'] = $bookingcomplete->updated_at;
        History::create($historytodatabase);

        \Mail::to($businessinfo->emailnotifications)->send(new BookingCreated($bookingcomplete));
        \Mail::to($bookingcomplete->User->email)->send(new BookingCreated($bookingcomplete));



    return view('bookingcreated', compact('bookingcomplete', 'sitecontent', 'currenthireprices', 'Hours'));

    }


    public function useredit(Booking $booking)
    {
        // WE ALLOW USERS TO UPDATE THEIR BOOKINGS BEFORE PAYING.

        // Checks the booking belongs to the current user.
        if(Auth::user()->id != $booking->User_id){
            return redirect()->route('home')->with('This is not your booking to adjust');
        }

        // Gets the associated bookings History.
        $history = History::where('Booking_id', '=', $booking->id)->first();

        // Gets the current time and date.
        $CarbonTimeAndDate = Carbon::now('Europe/London');

        // Re-configures the formatting of the $booking object and re assigns to the the attribute.
        $booking->Booking_start = date("Y-m-d H:i", strtotime($booking['Booking_start']));
        $booking->Booking_end = date("Y-m-d H:i", strtotime($booking['Booking_end']));

        // Checks if the History thinks the booking is: Deleted. Account is deleted, or if the user has already paid -> then redirects.
        if($history->status == 'DELETED' || $history->status == 'ACCOUNT-DELETED' || $booking->Payment_status == true ){
            if(Gate::allows('manage-users')){

            }else{
            return redirect()->route('user.bookings.index', $booking->User_id);
            }
        }

        // Then checks if the booking has ended and the user is trying to change the amount of time they
        if(Gate::allows('manage-users')){

        }else{
            if($CarbonTimeAndDate > $booking->Booking_end){
                return redirect()->route('user.bookings.index', $booking->User_id);
            }
        }

        // Then checks if the booking is within 12 hours of the booking starting
        if(Gate::allows('manage-users')){

        }else{
            if($CarbonTimeAndDate > date("Y-m-d H:i", strtotime('-12 hours',strtotime($booking->Booking_start)))){
                return redirect()->route('user.bookings.index', $booking->User_id);
            }
        }

        return view('user.bookings.edit', compact('booking', 'CarbonTimeAndDate'));
    }

    public function userupdate(Request $request, Booking $booking)
    {
        // The post method that actually updates the Users booking.

        // Confirms the user is authorised to update the booking.
        if(Auth::user()->id != $booking->User_id){
            return redirect()->route('home')->with('This is not your booking to adjust');
        }

        // Basic check to confirm the inout types are formatted correctly.
        $validatedrequest = $request->validate([
            'Booking_start_date' => ['required', 'date'],
            'Booking_start_time' => ['required', 'date_format:H:i'],
            'Booking_end_date' => ['required', 'date'],
            'Booking_end_time' => ['required', 'date_format:H:i'],
        ]);

        //------ Assigns the user inputs for booking start and end
        $datestart = $request->Booking_start_date;
        $dateend = $request->Booking_end_date;

        $timestart = $request->Booking_start_time;
        $timeend = $request->Booking_end_time;

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

        //Input validation
        if($datestart < $dateend ){
            $validatedrequest = $request->validate([
                'Room_id' => ['required', 'integer'],
                'User_id' => ['required', 'integer'],
                'Booking_start_date' => ['required', 'date'],
                'Booking_start_time' => ['required', 'date_format:H:i'],
                'Booking_end_date' => ['required', 'date', 'after_or_equal:Booking_start_date'],
                'Booking_end_time' => ['required', 'date_format:H:i'],
                'guitarheadamount' => ['required', 'numeric', 'min:0'],
                'guitarcabamount' => ['required', 'numeric', 'min:0'],
                'guitarcomboamount' => ['required', 'numeric', 'min:0'],
                'bassheadamount' => ['required', 'numeric', 'min:0'],
                'basscabamount' => ['required', 'numeric', 'min:0'],
                'basscomboamount' => ['required', 'numeric', 'min:0'],
                'drumkitamount' => ['required', 'numeric', 'min:0'],
                'cymbalsamount' => ['required', 'numeric', 'min:0'],
                'Payment_status' => ['boolean'],
            ]);
        }
        else{
            $validatedrequest = $request->validate([
                'Room_id' => ['required', 'integer'],
                'User_id' => ['required', 'integer'],
                'Booking_start_date' => ['required', 'date'],
                'Booking_start_time' => ['required', 'date_format:H:i'],
                'Booking_end_date' => ['required', 'date', 'after_or_equal:Booking_start_date'],
                'Booking_end_time' => ['required', 'date_format:H:i', 'after:Booking_start_time'],
                'guitarheadamount' => ['required', 'numeric', 'min:0'],
                'guitarcabamount' => ['required', 'numeric', 'min:0'],
                'guitarcomboamount' => ['required', 'numeric', 'min:0'],
                'bassheadamount' => ['required', 'numeric', 'min:0'],
                'basscabamount' => ['required', 'numeric', 'min:0'],
                'basscomboamount' => ['required', 'numeric', 'min:0'],
                'drumkitamount' => ['required', 'numeric', 'min:0'],
                'cymbalsamount' => ['required', 'numeric', 'min:0'],
                'Payment_status' => ['boolean'],
            ]);
        }

        // Assigns the previous Payment_status to a variable. Users can't change this themselves.
        $Payment_status = $booking->Payment_status;

        //------ Merges user inputs into DateTime objects
        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));

        //------ Minus a minute from one because Spatie/Businesshours is bugged.
        $rangefixedend = date("Y-m-d H:i",strtotime('-1 minute',strtotime("$dateend $timeend")));

        $beginstring = "$datestart $timestart";
        $endstring = "$dateend $timeend";

        //------ determins if theres a timeslot conflict in chosen room (EXCLUDES CURRENT BOOKING)
        $count = Booking::where('id', '!=', $booking->id)
            ->where('Room_id', $booking->Room_id)
            ->where(function ($query) use ($begin, $end) {
                $query->where(function ($q) use ($begin, $end) {
                    $q->where('Booking_start', '>=', $begin)
                    ->where('Booking_start', '<', $end);
                })->orWhere(function ($q) use ($begin, $end) {
                    $q->where('Booking_start', '<=', $begin)
                    ->where('Booking_end', '>', $end);
                })->orWhere(function ($q) use ($begin, $end) {
                    $q->where('Booking_end', '>', $begin)
                    ->where('Booking_end', '<=', $end);
                })->orWhere(function ($q) use ($begin, $end) {
                    $q->where('Booking_start', '>=', $begin)
                    ->where('Booking_end', '<=', $end);
                });
        })->count();

        if($count != 0){
            if($count == 1){
                return redirect()->back()->withInput()->with('Booking_query_error', 'The times ' . $timestart . ' and ' . $timeend . ' conflict with ' . $count . ' other booking');
            }
            else{
                return redirect()->back()->withInput()->with('Booking_query_error', 'The times ' . $timestart . ' and ' . $timeend . ' conflict with ' . $count . ' other bookings');
            }
        }

        //------ determines if theres a timeslot conflict with a Holiday.
        $count2 = Holiday::where(function ($query) use ($begin, $end) {
            $query->where(function ($q) use ($begin, $end) {
                $q->where('Holiday_start', '>=', $begin)
                ->where('Holiday_start', '<', $end);
            })->orWhere(function ($q) use ($begin, $end) {
                $q->where('Holiday_start', '<=', $begin)
                ->where('Holiday_end', '>', $end);
            })->orWhere(function ($q) use ($begin, $end) {
                $q->where('Holiday_end', '>', $begin)
                ->where('Holiday_end', '<=', $end);
            })->orWhere(function ($q) use ($begin, $end) {
                $q->where('Holiday_start', '>=', $begin)
                ->where('Holiday_end', '<=', $end);
            });
        })->count();

        if($count2 != 0){
            if($count2 == 1){
                return redirect()->back()->withInput()->with('Booking_query_error', 'The form fields you have entered conflict with a planned business holiday.');
            }
            else{
                return redirect()->back()->withInput()->with('Booking_query_error', 'The form fields you have entered conflict with a planned business holidays.');
            }
        }



        //------ Aims to prevent a user from having more than 4 future bookings at a time.
        $CarbonDate = date("Y-m-d H:s", strtotime(Carbon::now('Europe/London')));
        //------ Aims to prevent a user from booking too far in advance
        $CarbonDateplus = date("Y-m-d", strtotime('+90 days',strtotime(Carbon::now('Europe/London'))));

        $userid = auth()->user()->id;
        $mybookingcount = Booking::where('User_id', '=', $userid)
                        ->where('Booking_start', '>=', $CarbonDate)
                        ->count();


        if(($mybookingcount - 1) >= 4){
            if(Gate::allows('manage-users')){

            }else{
                return redirect()->back()->withInput()->with('Booking_query_error', 'Unfortunatly, users of our system can only have 4 future bookings at any one time.');

            }
        }

        if(Gate::allows('manage-users')){

        }else{
            if($end > $CarbonDateplus)
            {
                return redirect()->back()->withInput()->with('Booking_query_error', 'Unfortunatly, users of our system can only book 90 days into the future.');
            }
        }

        if(Gate::allows('manage-users')){

        }else{

            if($begin < $CarbonDate)
            {
            return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly, the start of your booking must occur in the future. Check your 'Start date' and 'Start time'.");
            }
        }


        if(Gate::allows('manage-users')){

        }else{
            //------ Gets the currently set business hours and assigns them in time format.

            $b = BusinessHour::find('1');
            $b->Mondaystart = date("H:i", strtotime($b->Mondaystart));
            $b->Mondayend = date("H:i", strtotime($b->Mondayend));
            $b->Tuesdaystart = date("H:i", strtotime($b->Tuesdaystart));
            $b->Tuesdayend = date("H:i", strtotime($b->Tuesdayend));
            $b->Wednesdaystart = date("H:i", strtotime($b->Wednesdaystart));
            $b->Wednesdayend = date("H:i", strtotime($b->Wednesdayend));
            $b->Thursdaystart = date("H:i", strtotime($b->Thursdaystart));
            $b->Thursdayend = date("H:i", strtotime($b->Thursdayend));
            $b->Fridaystart = date("H:i", strtotime($b->Fridaystart));
            $b->Fridayend = date("H:i", strtotime($b->Fridayend));
            $b->Saturdaystart = date("H:i", strtotime($b->Saturdaystart));
            $b->Saturdayend = date("H:i", strtotime($b->Saturdayend));
            $b->Sundaystart = date("H:i", strtotime($b->Sundaystart));
            $b->Sundayend = date("H:i", strtotime($b->Sundayend));

            //------ Uses them to create the Spatie/Opening hours type object to reference against.

            $openingHours = OpeningHours::create([
                'monday'     => [$b->Mondaystart . '-' . $b->Mondayend],
                'tuesday'    => [$b->Tuesdaystart . '-' . $b->Tuesdayend],
                'wednesday'  => [$b->Wednesdaystart . '-' . $b->Wednesdayend],
                'thursday'   => [$b->Thursdaystart . '-' . $b->Thursdayend],
                'friday'     => [$b->Fridaystart . '-' . $b->Fridayend],
                'saturday'   => [$b->Saturdaystart . '-' . $b->Saturdayend],
                'sunday'     => [$b->Sundaystart . '-' . $b->Sundayend],
                'exceptions' => [
                    '2016-11-11' => ['09:00-12:00'],
                    '2016-12-25' => [],
                //  '01-01'      => [],                // Recurring on each 1st of January
                //  '12-25'      => ['09:00-12:00'],   // Recurring on each 25th of December
                ],
            ]);

            //------ Feeds chosen times and dates into the Opening Hours object we created.
            //------ If it doesn't find that the business is open, it is closed.

            ///////////////////// Opening hours check

            $openinghourscheck = $begin;
            $openinghoursendcheck = date("Y-m-d H:i", strtotime('+29 minutes',strtotime($begin)));

            //---- Check stock for every 30 minute slot between the customers chosen time
            do {

                    $rangebegin = $openingHours->currentOpenRange(new DateTime($openinghourscheck));
                    $rangeend = $openingHours->currentOpenRange(new DateTime($openinghoursendcheck));

                    if($rangebegin == false){
                        return redirect()->back()->withInput()->with('Booking_query_error', "Sorry, we aren't open at those times. Please check the bottom of the page for our business hours.");

                    }elseif($rangeend == false){
                        return redirect()->back()->withInput()->with('Booking_query_error', "Sorry, we aren't open at those times. Please check the bottom of the page for our business hours.");
                    }

                    //---- Set the next 30 minute slot to check.
                    $openinghourscheck = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($openinghourscheck)));
                    $openinghoursendcheck = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($openinghoursendcheck)));

            } while ($openinghourscheck != $end);
        }

        ///////////////////// END OF OPENING HOURS

        //Determines timecost of booking (DATETIME to TIME)
        $start = strtotime($begin);
        $end2 = strtotime($end);

        $Difference = $end2 - $start;
        $Hours = $Difference / 3600;

        $room = Room::all()->get(($request->Room_id) - 1);
        $CostOfBooking = $Hours * $booking->Room->priceperhour;

        //----- Gets Hire Prices and STOCK
        $currenthireprices = HirePrice::all()->first();

        //----- Gets the proposed equipment amounts and assigns to variables.
        $guitarheadamount = intval($request->guitarheadamount);
        $guitarcabamount = intval($request->guitarcabamount);
        $guitarcomboamount = intval($request->guitarcomboamount);
        $bassheadamount = intval($request->bassheadamount);
        $basscabamount = intval($request->basscabamount);
        $basscomboamount = intval($request->basscomboamount);
        $drumkitamount = intval($request->drumkitamount);
        $cymbalsamount = intval($request->cymbalsamount);

        //----- Sets counts to zero.
        $guitarheadcount = 0;
        $guitarcabcount = 0;
        $guitarcombocount = 0;
        $bassheadcount = 0;
        $basscabcount = 0;
        $basscombocount = 0;
        $drumkitcount = 0;
        $cymbalscount = 0;

       //---- STOCK CHECK TIME

       $stockcheckbegin = $begin;
       $stockcheckend = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($begin)));

       $tempguitarheadcount = 0;
       $tempguitarcabcount = 0;
       $tempguitarcombocount = 0;
       $tempbassheadcount = 0;
       $tempbasscabcount = 0;
       $tempbasscombocount = 0;
       $tempdrumkitcount = 0;
       $tempcymbalscount = 0;

       //---- Check stock for every 30 minute slot between the customers chosen time
       //---- Note: Excluded the room we're currently looking at...
       do {
           $otherbookings = Booking::orderby('Booking_start', 'ASC')
           ->where('Room_id', '!=', $booking->Room_id)
           ->where(function ($query) use ($stockcheckbegin, $stockcheckend) {
               $query->where(function ($q) use ($stockcheckbegin, $stockcheckend) {
                   $q->where('Booking_start', '>=', $stockcheckbegin)
                   ->where('Booking_start', '<', $stockcheckend);
               })->orWhere(function ($q) use ($stockcheckbegin, $stockcheckend) {
                   $q->where('Booking_start', '<=', $stockcheckbegin)
                   ->where('Booking_end', '>', $stockcheckend);
               })->orWhere(function ($q) use ($stockcheckbegin, $stockcheckend) {
                   $q->where('Booking_end', '>', $stockcheckbegin)
                   ->where('Booking_end', '<=', $stockcheckend);
               })->orWhere(function ($q) use ($stockcheckbegin, $stockcheckend) {
                   $q->where('Booking_start', '>=', $stockcheckbegin)
                   ->where('Booking_end', '<=', $stockcheckend);
               });
           })->get();

           foreach($otherbookings as $other){

               $tempguitarheadcount = $tempguitarheadcount + $other->Equip->guitarheadamount;
               $tempguitarcabcount = $tempguitarcabcount + $other->Equip->guitarcabamount;
               $tempguitarcombocount = $tempguitarcombocount + $other->Equip->guitarcomboamount;
               $tempbassheadcount = $tempbassheadcount + $other->Equip->bassheadamount;
               $tempbasscabcount = $tempbasscabcount + $other->Equip->basscabamount;
               $tempbasscombocount = $tempbasscombocount + $other->Equip->basscomboamount;
               $tempdrumkitcount = $tempdrumkitcount + $other->Equip->drumkitamount;
               $tempcymbalscount = $tempcymbalscount + $other->Equip->cymbalsamount;

               if(($currenthireprices->guitarheadstock - ($guitarheadamount + $tempguitarheadcount)) < 0){
                   return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Guitar Head' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
               }
               if(($currenthireprices->guitarcabstock - ($guitarcabamount + $tempguitarcabcount)) < 0){
                   return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Guitar Cab' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
               }
               if(($currenthireprices->guitarcombostock - ($guitarcomboamount + $tempguitarcombocount)) < 0){
                   return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Guitar Combo' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
               }
               if(($currenthireprices->bassheadstock - ($bassheadamount + $tempbassheadcount)) < 0){
                   return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Bass Head' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
               }
               if(($currenthireprices->basscabstock - ($basscabamount + $tempbasscabcount)) < 0){
                   return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Bass Cab' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
               }
               if(($currenthireprices->basscombostock - ($basscomboamount + $tempbasscombocount)) < 0){
                   return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Bass Combo' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
               }
               if(($currenthireprices->drumkitstock - ($drumkitamount + $tempdrumkitcount)) < 0){
                   return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our 'Drum kit' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
               }
               if(($currenthireprices->cymbalsstock - ($cymbalsamount + $tempcymbalscount)) < 0){
                   return redirect()->back()->withInput()->with('Booking_query_error', "Sorry! Our sets of 'Cymbals' stock will run out during the course of this booking. (Between $stockcheckbegin and $stockcheckend)");
               }
           }
                //---- Passed? then reset the counts.
               $tempguitarheadcount = 0;
               $tempguitarcabcount = 0;
               $tempguitarcombocount = 0;
               $tempbassheadcount = 0;
               $tempbasscabcount = 0;
               $tempbasscombocount = 0;
               $tempdrumkitcount = 0;
               $tempcymbalscount = 0;

               //---- Set the next 30 minute slot to check.
               $stockcheckbegin = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($stockcheckbegin)));
               $stockcheckend = date("Y-m-d H:i", strtotime('+30 minutes',strtotime($stockcheckend)));

       } while ($stockcheckbegin != $end);

       //---- For when there aren't any bookings but they still want more stock then is available.
       if(($currenthireprices->guitarheadstock - ($guitarheadamount + $guitarheadcount)) < 0){
           return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $guitarheadamount guitar heads available between $timestart and $timeend. There's $currenthireprices->guitarheadstock in stock and $guitarheadcount in use.");
       }
       if(($currenthireprices->guitarcabstock - ($guitarcabamount + $guitarcabcount)) < 0){
           return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $guitarcabamount 'Guitar cabs' available between $timestart and $timeend. There's $currenthireprices->guitarcabstock in stock and $guitarcabcount in use.");
       }
       if(($currenthireprices->guitarcombostock - ($guitarcomboamount + $guitarcombocount)) < 0){
           return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $guitarcomboamount 'Guitar combos' available between $timestart and $timeend. There's $currenthireprices->guitarcombostock in stock and $guitarcombocount in use.");
       }
       if(($currenthireprices->bassheadstock - ($bassheadamount + $bassheadcount)) < 0) {
           return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $bassheadamount 'Bass heads' available between $timestart and $timeend. There's $currenthireprices->bassheadstock in stock and $bassheadcount in use.");
       }
       if(($currenthireprices->basscabstock - ($basscabamount + $basscabcount)) < 0) {
           return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $basscabamount 'Bass cabs' available between $timestart and $timeend. There's $currenthireprices->basscabstock in stock and $basscabcount in use.");
       }
       if(($currenthireprices->basscombostock - ($basscomboamount + $basscombocount)) < 0){
           return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $basscomboamount 'Bass combos' available between $timestart and $timeend. There's $currenthireprices->basscombostock in stock and $basscombocount in use.");
       }
       if(($currenthireprices->drumkitstock - ($drumkitamount + $drumkitcount)) < 0){
           return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $drumkitamount 'Drum kits' available between $timestart and $timeend. There's $currenthireprices->drumkitstock in stock and $drumkitcount in use.");
       }
       if(($currenthireprices->cymbalsstock - ($cymbalsamount + $cymbalscount)) < 0){
           return redirect()->back()->withInput()->with('Booking_query_error', "Unfortunatly there aren't $cymbalsamount 'sets of cymbals' available between $timestart and $timeend. There's $currenthireprices->cymbalsstock in stock and $cymbalscount in use.");
       }

       //----- END OF STOCK CHECK

       //----- Calculate prices for equipment.
        $equipmenttotal = 0;
        $equipmenttotal = $equipmenttotal + ($currenthireprices->guitarhead * $guitarheadamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->guitarcab * $guitarcabamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->guitarcombo * $guitarcomboamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->basshead * $bassheadamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->basscab * $basscabamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->basscombo * $basscomboamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->drumkit * $drumkitamount);
        $equipmenttotal = $equipmenttotal + ($currenthireprices->cymbals * $cymbalsamount);
        $CostOfBooking = $CostOfBooking + $equipmenttotal;

        //----- Don't need to check if a room is unavailable.

        // Get's the Businessinfo because of the mailto: link in the HTML.
        $businessinfo = BusinessInfo::find('1');

        $booking->Room_id = $request->Room_id;
        $booking->User_id = $request->User_id;
        $booking->Booking_start = $beginstring;
        $booking->Booking_end = $endstring;
        $booking->Equip->guitarheadamount = $request->guitarheadamount;
        $booking->Equip->guitarcabamount = $request->guitarcabamount;
        $booking->Equip->guitarcomboamount = $request->guitarcomboamount;
        $booking->Equip->bassheadamount = $request->bassheadamount;
        $booking->Equip->basscabamount = $request->basscabamount;
        $booking->Equip->basscomboamount = $request->basscomboamount;
        $booking->Equip->drumkitamount = $request->drumkitamount;
        $booking->Equip->cymbalsamount = $request->cymbalsamount;
        $booking->Equip->equiptotal = $equipmenttotal;
        $booking->Cost_of_booking = $CostOfBooking;
        $booking->Payment_status = $Payment_status;
        $booking->save();
        $booking->Equip->save();

        $now = Carbon::now();

        $history = History::where('Booking_id', '=', $booking->id)->first();

        $history->Booking_id = $booking->id;
        $history->Room_id = $booking->Room_id;
        $history->roomname = $booking->Room->roomname;
        $history->priceperhour = $booking->Room->priceperhour;
        $history->User_id = $booking->User_id;
        $history->name = $booking->User->name;
        $history->surname = $booking->User->surname;
        $history->band = $booking->User->band;
        $history->email = $booking->User->email;
        $history->Booking_start = $booking->Booking_start;
        $history->Booking_end = $booking->Booking_end;
        $history->status = 'UPDATED';
        $history->Payment_status = $Payment_status;
        $history->Cost_of_booking = $CostOfBooking;
        $history->equiptotal = $equipmenttotal;
        $history->wascreated_at = $booking->created_at;
        $history->wasupdated_at = $now;
        $history->save();

        \Mail::to($businessinfo->emailnotifications)->send(new BookingUpdated($booking));

        \Mail::to($booking->User->email)->send(new BookingUpdated($booking));

        return redirect()->route('user.bookings.index', $booking->User_id);

    }

    public function usershow(Booking $booking)
    {
        // Again, checks if the user is allowed to view the page.

        if(Auth::user()->id != $booking->User_id){
            return redirect()->route('home')->with('This is not your booking to adjust');
        }

        //Get the associated history that has the same ID.
        $history = History::where('Booking_id', '=', $booking->id)->first();
        $CarbonTimeAndDate = Carbon::now('Europe/London');
        $booking->Booking_start = date("Y-m-d H:i", strtotime($booking['Booking_start']));
        $booking->Booking_end = date("Y-m-d H:i", strtotime($booking['Booking_end']));

        // Checks if the History thinks the booking is: Deleted. Account is deleted, or if the user has already paid -> then redirects.
        if($history->status == 'DELETED' || $history->status == 'ACCOUNT-DELETED' || $booking->Payment_status == true ){
            if(Gate::allows('manage-users')){

            }else{
            return redirect()->route('user.bookings.index', $booking->User_id);
            }
        }
        // Then checks if the booking has ended and the user is trying to change the amount of time they had
        if(Gate::allows('manage-users')){

        }else{
            if($CarbonTimeAndDate > $booking->Booking_end){
                return redirect()->route('user.bookings.index', $booking->User_id);
            }
        }

        // Then checks if the booking is within 12 hours of the booking starting
        if(Gate::allows('manage-users')){

        }else{
            if($CarbonTimeAndDate > date("Y-m-d H:i", strtotime('-12 hours',strtotime($booking->Booking_start)))){
                return redirect()->route('user.bookings.index', $booking->User_id);
            }
        }


        return view('user.bookings.show', compact('booking', 'CarbonTimeAndDate'));
    }

    public function userdestroy(Booking $booking)
    {
        // One final check.
        if(Auth::user()->id != $booking->User_id){
            return redirect()->route('home')->with('This is not your booking to adjust');
        }

        // Get's the Businessinfo because of the mailto: link in the HTML.
        $businessinfo = BusinessInfo::find('1');

        // Get the History again and update it's status to say DELETED.
        $history = History::where('Booking_id', '=', $booking->id)->first();
        $history->status = 'DELETED';
        $history->save();

         \Mail::to($businessinfo->emailnotifications)->send(new BookingDeleted($booking));
        // Then actually delete the booking.
        $booking->delete();

        return redirect()->route('user.bookings.index', $booking->User_id);
    }

    public function paynow(Booking $booking)
    {
        // One final check.
        if(Auth::user()->id != $booking->User_id){
            return redirect()->route('home')->with('This is not your booking to adjust');
        }

        // Get the History again and update it's Payment_status to say TRUE.
        $history = History::where('Booking_id', '=', $booking->id)->first();
        $history->Payment_status = 1;
        $history->save();

        //Same for Booking Itself.
        $booking->Payment_status = 1;
        $booking->save();

        return redirect()->route('user.bookings.index', $booking->User_id);
    }

}
