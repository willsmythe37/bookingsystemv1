<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\HirePrice as HirePrice;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class HirePricesController extends Controller
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(HirePrice $hireprice)
    {
        // pass the object straight through to the view.

        return view('admin.hireprices.edit', compact('hireprice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HirePrice $hireprice)
    {
        // Validate the inputs to be sure they're OK.
        $validatedrequest = $request->validate([
            'guitarhead' => ['required', 'numeric', 'min:0'],
            'guitarcab' => ['required', 'numeric', 'min:0'],
            'guitarcombo' => ['required', 'numeric', 'min:0'],
            'guitarheadstock' => ['required', 'numeric', 'min:0'],
            'guitarcabstock' => ['required', 'numeric', 'min:0'],
            'guitarcombostock' => ['required', 'numeric', 'min:0'],
            'basshead' => ['required', 'numeric', 'min:0'],
            'basscab' => ['required', 'numeric', 'min:0'],
            'basscombo' => ['required', 'numeric', 'min:0'],
            'bassheadstock' => ['required', 'numeric', 'min:0'],
            'basscabstock' => ['required', 'numeric', 'min:0'],
            'basscombostock' => ['required', 'numeric', 'min:0'],
            'drumkit' => ['required', 'numeric', 'min:0'],
            'cymbals' => ['required', 'numeric', 'min:0'],
            'drumkitstock' => ['required', 'numeric', 'min:0'],
            'cymbalsstock' => ['required', 'numeric', 'min:0'],
        ]);

        // Assign the values, and save.
        $hireprice->guitarhead = $request->guitarhead;
        $hireprice->guitarcab = $request->guitarcab;
        $hireprice->guitarcombo = $request->guitarcombo;
        $hireprice->guitarheadstock = $request->guitarheadstock;
        $hireprice->guitarcabstock = $request->guitarcabstock;
        $hireprice->guitarcombostock = $request->guitarcombostock;
        $hireprice->basshead = $request->basshead;
        $hireprice->basscab = $request->basscab;
        $hireprice->basscombo = $request->basscombo;
        $hireprice->bassheadstock = $request->bassheadstock;
        $hireprice->basscabstock = $request->basscabstock;
        $hireprice->basscombostock = $request->basscombostock;
        $hireprice->drumkit = $request->drumkit;
        $hireprice->cymbals = $request->cymbals;
        $hireprice->drumkitstock = $request->drumkitstock;
        $hireprice->cymbalsstock = $request->cymbalsstock;

        $hireprice->save();

        return redirect()->route('home');
    }

}
