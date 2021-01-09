<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AdminController extends Controller
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

    public function display(Request $request)
    {
        // This is the user search function that is bolted into the User Management section.
        // This is because the Users controller is a resource controller with fixed method titles so a Search couldn't be added to it.

        // Validates the input.
        $validatedrequest = $request->validate([
            'search' => ['string', 'max:50'],
        ]);

        // Assigns the user input to a variable.
        $search = $request->search;

        // Get's the user's that are like the search term.
        $display = User::where('name', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('surname', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('band', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('phonenumber', 'LIKE', '%'.$request->search.'%')
                    ->orwhere('email', 'LIKE', '%'.$request->search.'%')
                    ->get();

        return view('admin.search.display', compact('display', 'search'));
    }

    public function mailinglist()
    {
        $mailinglists = User::all()->chunk(40);

        return view('admin.search.mailinglist', compact('mailinglists'));
    }
}
