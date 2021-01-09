<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\History;
use App\Booking;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
Use \Carbon\Carbon;

class HistoryController extends Controller
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
        // The 2x DB queries are required to fill the 'More information sections within Historys searches.
        // This is because otherwise the pagination interferes with the calculations.
        $history = History::orderBy('Booking_end', 'DESC')->paginate(8);
        $history2 = History::orderBy('Booking_end', 'DESC')->get();

        $now = Carbon::now('Europe/London');

        $equipsum = 0;
        $roomsum  = 0;
        $totalsum = 0;
        $hoursum = 0;

        foreach($history2 as $h){
            if($h->status != "DELETED"){
            $equipsum = $equipsum + $h->equiptotal;
            $roomsum  = $roomsum + ($h->Cost_of_booking - $h->equiptotal);
            $totalsum = $totalsum + $h->Cost_of_booking;
            $hrs = (strtotime($h->Booking_end) - strtotime($h->Booking_start)) / 3600;
            $hoursum = $hoursum + $hrs;
            }
        }
        $historycount = $history2->count();
        $historycountdeleted = $history2->where('status', '=', 'DELETED')->count();

        return view('admin.history.index', compact('history', 'now', 'equipsum', 'roomsum', 'totalsum', 'hoursum', 'historycount', 'historycountdeleted'));
    }

    public function usershow(User $user)
    {
        $history = History::orderBy('Booking_end', 'DESC')
        ->where('User_id', '=', $user->id)->paginate(8);

        $history2 = History::orderBy('Booking_end', 'DESC')
        ->where('User_id', '=', $user->id)->get();

        $now = Carbon::now('Europe/London');

        $equipsum = 0;
        $roomsum  = 0;
        $totalsum = 0;
        $hoursum = 0;

        foreach($history2 as $h){
            if($h->status != "DELETED"){
            $equipsum = $equipsum + $h->equiptotal;
            $roomsum  = $roomsum + ($h->Cost_of_booking - $h->equiptotal);
            $totalsum = $totalsum + $h->Cost_of_booking;
            $hrs = ((strtotime($h->Booking_end) - strtotime($h->Booking_start)) / 3600);
            $hoursum = $hoursum + $hrs;
            }
        }
        $historycount = $history2->count();
        $historycountdeleted = $history2->where('status', '=', 'DELETED')->count();

        return view('admin.history.usershow', compact('history', 'now', 'equipsum', 'roomsum', 'totalsum', 'hoursum', 'historycount', 'historycountdeleted'));
    }

    public function search(Request $request)
    {
        $validatedrequest = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
        ]);
        $search = $request->search;

        $now = Carbon::now('Europe/London');

        $history = History::orderBy('Booking_end', 'DESC')
                    ->where('name', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('surname', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('band', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('email', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('roomname', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('status', 'LIKE', '%'.$request->search.'%')
                    ->paginate(8);

        $equipsum = 0;
        $roomsum  = 0;
        $totalsum = 0;
        $hoursum = 0;

        $history2 = History::orderBy('Booking_end', 'DESC')
                    ->where('name', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('surname', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('band', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('email', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('roomname', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('status', 'LIKE', '%'.$request->search.'%')
                    ->get();


        foreach($history2 as $h){
            if($h->status != "DELETED"){
            $equipsum = $equipsum + $h->equiptotal;
            $roomsum  = $roomsum + ($h->Cost_of_booking - $h->equiptotal);
            $totalsum = $totalsum + $h->Cost_of_booking;
            $hrs = ((strtotime($h->Booking_end) - strtotime($h->Booking_start)) / 3600);
            $hoursum = $hoursum + $hrs;
            }
        }
        $historycount = $history2->count();
        $historycountdeleted = $history2->where('status', '=', 'DELETED')->count();

        return view('admin.history.search', compact('search', 'history', 'now', 'equipsum', 'roomsum', 'totalsum', 'hoursum', 'historycount', 'historycountdeleted'));
    }

    public function range(Request $request)
    {
        $validatedrequest = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'Booking_start_date' => ['required', 'date'],
            'Booking_start_time' => ['required', 'date_format:H:i'],
            'Booking_end_date' => ['required', 'date'],
            'Booking_end_time' => ['required', 'date_format:H:i'],
        ]);

        $search = $request->input('search');
        $datestart = $request->input('Booking_start_date');
        $dateend = $request->input('Booking_end_date');

        $timestart = $request->input('Booking_start_time');
        $timeend = $request->input('Booking_end_time');

        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));

        $now = Carbon::now('Europe/London');

        if($search == null){

        $history = History::orderBy('Booking_end', 'DESC')
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
         })->paginate(8);

        $equipsum = 0;
        $roomsum  = 0;
        $totalsum = 0;
        $hoursum = 0;

         $history2 = History::orderBy('Booking_end', 'DESC')
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
         })->get();

        foreach($history2 as $h){
            if($h->status != "DELETED"){
            $equipsum = $equipsum + $h->equiptotal;
            $roomsum  = $roomsum + ($h->Cost_of_booking - $h->equiptotal);
            $totalsum = $totalsum + $h->Cost_of_booking;
            $hrs = ((strtotime($h->Booking_end) - strtotime($h->Booking_start)) / 3600);
            $hoursum = $hoursum + $hrs;
            }
        }
        $historycount = $history2->count();
        $historycountdeleted = $history2->where('status', '=', 'DELETED')->count();
    }
    else{
        $history = History::orderBy('Booking_end', 'desc')
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
         })->where(function ($query) use ($request) {
         $query->where('name', 'LIKE', '%'.$request->search.'%')
         ->orwhere('surname', 'LIKE', '%'.$request->search.'%')
         ->orwhere('band', 'LIKE', '%'.$request->search.'%')
         ->orwhere('email', 'LIKE', '%'.$request->search.'%')
         ->orwhere('roomname', 'LIKE', '%'.$request->search.'%')
         ->orwhere('status', 'LIKE', '%'.$request->search.'%');
        })->paginate(8);

        $equipsum = 0;
        $roomsum  = 0;
        $totalsum = 0;
        $hoursum = 0;

        $history2 = History::orderBy('Booking_end', 'desc')
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
})->where(function ($query) use ($request) {
    $query->where('name', 'LIKE', '%'.$request->search.'%')
    ->orwhere('surname', 'LIKE', '%'.$request->search.'%')
    ->orwhere('band', 'LIKE', '%'.$request->search.'%')
    ->orwhere('email', 'LIKE', '%'.$request->search.'%')
    ->orwhere('roomname', 'LIKE', '%'.$request->search.'%')
    ->orwhere('status', 'LIKE', '%'.$request->search.'%');
   })->get();

        foreach($history2 as $h){
            if($h->status != "DELETED"){
            $equipsum = $equipsum + $h->equiptotal;
            $roomsum  = $roomsum + ($h->Cost_of_booking - $h->equiptotal);
            $totalsum = $totalsum + $h->Cost_of_booking;
            $hrs = ((strtotime($h->Booking_end) - strtotime($h->Booking_start)) / 3600);
            $hoursum = $hoursum + $hrs;
            }
        }
        $historycount = $history2->count();
        $historycountdeleted = $history2->where('status', '=', 'DELETED')-> count();
    }

        return view('admin.history.range', compact('history', 'search', 'begin', 'end', 'now', 'equipsum', 'roomsum', 'totalsum', 'hoursum', 'historycount', 'historycountdeleted'));
    }

    public function clearup()
    {
        $now = Carbon::now('Europe/London');

        return view('admin.history.clearup', compact('now'));
    }

    public function clearupshow(Request $request)
    {
        $validatedrequest = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'Booking_start_date' => ['required', 'date'],
            'Booking_start_time' => ['required', 'date_format:H:i'],
            'Booking_end_date' => ['required', 'date'],
            'Booking_end_time' => ['required', 'date_format:H:i'],
        ]);

        $search = $request->input('search');

        $datestart = $request->input('Booking_start_date');
        $dateend = $request->input('Booking_end_date');

        $timestart = $request->input('Booking_start_time');
        $timeend = $request->input('Booking_end_time');

        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));
        $now = Carbon::now('Europe/London');

        if($search == null){

        $history = History::orderBy('Booking_end', 'desc')
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
         })->get();
        }
        else{
            $history = History::orderBy('Booking_end', 'desc')
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
         })->where(function ($query) use ($request) {
            $query->where('name', 'LIKE', '%'.$request->search.'%')
            ->orwhere('surname', 'LIKE', '%'.$request->search.'%')
            ->orwhere('band', 'LIKE', '%'.$request->search.'%')
            ->orwhere('email', 'LIKE', '%'.$request->search.'%')
            ->orwhere('roomname', 'LIKE', '%'.$request->search.'%')
            ->orwhere('status', 'LIKE', '%'.$request->search.'%');
           })->get();

        }

        return view('admin.history.clearupshow', compact('history', 'search', 'datestart', 'dateend', 'timestart', 'timeend', 'now', 'begin', 'end'));
    }

    public function clearout(Request $request)
    {
        $validatedrequest = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'Booking_start_date' => ['required', 'date'],
            'Booking_start_time' => ['required', 'date_format:H:i'],
            'Booking_end_date' => ['required', 'date'],
            'Booking_end_time' => ['required', 'date_format:H:i'],
        ]);

        $search = $request->input('search');

        $datestart = $request->input('Booking_start_date');
        $dateend = $request->input('Booking_end_date');

        $timestart = $request->input('Booking_start_time');
        $timeend = $request->input('Booking_end_time');

        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));

        $now = Carbon::now('Europe/London');

        if($search == null){
            $history = History::where(function ($query) use ($begin, $end) {
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
        })->get();

        }
        else{
            $history = History::orderBy('Booking_end', 'desc')
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
         })->where(function ($query) use ($request) {
            $query->where('name', 'LIKE', '%'.$request->search.'%')
            ->orwhere('surname', 'LIKE', '%'.$request->search.'%')
            ->orwhere('band', 'LIKE', '%'.$request->search.'%')
            ->orwhere('email', 'LIKE', '%'.$request->search.'%')
            ->orwhere('roomname', 'LIKE', '%'.$request->search.'%')
            ->orwhere('status', 'LIKE', '%'.$request->search.'%');
           })->get();
        }


         foreach($history as $h){
             $h->delete();
         }

         return redirect()->route('admin.history.index');
    }

    public function nuclear(Request $request)
    {
        $validatedrequest = $request->validate([
            'Booking_start_date' => ['required', 'date'],
            'Booking_start_time' => ['required', 'date_format:H:i'],
            'Booking_end_date' => ['required', 'date'],
            'Booking_end_time' => ['required', 'date_format:H:i'],
        ]);

        $search = $request->input('search');

        $datestart = $request->input('Booking_start_date');
        $dateend = $request->input('Booking_end_date');

        $timestart = $request->input('Booking_start_time');
        $timeend = $request->input('Booking_end_time');

        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));
        $now = Carbon::now('Europe/London');

        if($search == null){

        $history = History::orderBy('Booking_end', 'desc')
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
         })->get();
        }
        else{
            $history = History::orderBy('Booking_end', 'desc')
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
         })->get();

        }

        return view('admin.history.nuclear', compact('history', 'datestart', 'dateend', 'timestart', 'timeend', 'now', 'begin', 'end'));
    }

    public function nuclearout(Request $request)
    {
        $validatedrequest = $request->validate([
            'Booking_start_date' => ['required', 'date'],
            'Booking_start_time' => ['required', 'date_format:H:i'],
            'Booking_end_date' => ['required', 'date'],
            'Booking_end_time' => ['required', 'date_format:H:i'],
        ]);

        $datestart = $request->input('Booking_start_date');
        $dateend = $request->input('Booking_end_date');

        $timestart = $request->input('Booking_start_time');
        $timeend = $request->input('Booking_end_time');

        $begin = date("Y-m-d H:i", strtotime("$datestart $timestart"));
        $end = date("Y-m-d H:i", strtotime("$dateend $timeend"));

        $now = Carbon::now('Europe/London');


            $bookings = Booking::where(function ($query) use ($begin, $end) {
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
        })->get();



            $history = History::orderBy('Booking_end', 'desc')
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
        })->get();

        foreach($history as $h){
             $h->delete();
        }
        foreach($bookings as $h){
            $h->delete();
        }

         return redirect()->route('admin.history.index');
    }
}
