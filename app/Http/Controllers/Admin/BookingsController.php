<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Redirect;
use App\Booking as Booking;
use App\User as User;
use App\Room as Room;
use App\HirePrice as HirePrice;
use App\History as History;
use Gate;

use App\Holiday as Holiday;
use Auth;
use App\BusinessInfo as BusinessInfo;
use App\BusinessHours as BusinessHours;
Use \Carbon\Carbon;


class BookingsController extends Controller
{
    //
    public function index()
    {
        // Admins Bookings Resource controller.

        // the landing page displays all current bookings in the system.
        $bookings = Booking::orderBy('Booking_end', 'DESC')->paginate(8);

        // This foreach amends the format of the data coming back from the DB.
        foreach($bookings as $booking){
        $booking->Booking_start = date("Y-m-d H:i", strtotime($booking['Booking_start']));
        $booking->Booking_end = date("Y-m-d H:i", strtotime($booking['Booking_end']));
        }

        // Passes the current time for reference within the View.
        $CarbonTimeAndDate = Carbon::now('Europe/London');

        return view('admin.bookings.index', compact('bookings', 'CarbonTimeAndDate'));
    }

    public function edit(Booking $booking)
    {
        // An admin has selected a booking to edit.
        // This method checks the status of the bookings history... to make sure we can't get a deleted booking.

        $history = History::where('Booking_id', '=', $booking->id)->first();
        $CarbonTimeAndDate = Carbon::now('Europe/London');

        // Confirms the format of the bookings starts and ends.
        $booking->Booking_start = date("Y-m-d H:i", strtotime($booking['Booking_start']));
        $booking->Booking_end = date("Y-m-d H:i", strtotime($booking['Booking_end']));

        // Redirects if the booking history shows 'Deleted, account deleted'.
        if($history->status == 'DELETED' || $history->status == 'ACCOUNT-DELETED'){
            return redirect()->route('admin.history.index');
        }

        return view('admin.bookings.edit', compact('booking', 'CarbonTimeAndDate'));
    }

    public function update(Request $request, Booking $booking)
    {
        // Admins booking post/update function

        // Validate the initial date inputs.
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

        // Passes the Payment status input to a variable. Only available in the admin Booking update.
        $Payment_status = $request->Payment_status;

        //------ Merges user inputs into DateTime objects
        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));

        //------ Minus a minute from one because Spatie/Businesshours is bugged.
        $rangefixedend = date("Y-m-d H:i",strtotime('-1 minute',strtotime("$dateend $timeend")));

        $beginstring = "$datestart $timestart";
        $endstring = "$dateend $timeend";

        //------ determines if theres a timeslot conflict in chosen room (EXCLUDES CURRENT BOOKING)
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
                    return redirect()->back()->withInput()->with('Booking_query_error', 'The form fields you have entered conflict with a planned business holiday.');
                }
                else{
                    return redirect()->back()->withInput()->with('Booking_query_error', 'The form fields you have entered conflict with a planned business holidays.');
                }
            }
        }

        //ADMINS CAN BOOK BEYOND 90 days in advance.

            ///-------

        //ADMINS CAN BOOK OUTSIDE OF HOURS

            ///-------


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

        $history = History::select()
        ->where('Booking_id', '=', $booking->id)->first();

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


        return redirect()->route('admin.history.index');

    }

    public function show(Booking $booking)
    {
        // Gets and checks the history to determine the status.
        $history = History::where('Booking_id', '=', $booking->id)->first();
        $CarbonTimeAndDate = Carbon::now('Europe/London');
        $booking->Booking_start = date("Y-m-d H:i", strtotime($booking['Booking_start']));
        $booking->Booking_end = date("Y-m-d H:i", strtotime($booking['Booking_end']));

        // A method to catch whether a booking has already been deleted, the associated account is deleted.
        if($history->status == 'DELETED' || $history->status == 'ACCOUNT-DELETED'){
            return redirect()->route('admin.history.index');
        }


        return view('admin.bookings.show', compact('booking', 'CarbonTimeAndDate'));
    }

    public function destroy(Booking $booking, User $user)
    {
        //
        $history = History::where('Booking_id', '=', $booking->id)->first();
        $history->status = 'DELETED';
        $history->save();

        $booking->delete();

        return redirect()->route('admin.history.index');
    }
}
