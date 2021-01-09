<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\BusinessInfo as BusinessInfo;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BusinessInfoController extends Controller
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
    public function edit(BusinessInfo $businessinfo)
    {
        //
        // Passes the businessinfo straight through.

        return view('admin.businessinfo.edit', compact('businessinfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessInfo $businessinfo)
    {
        // A mechanism to update the business info shown on the site.

        // First validate the form inputs.
        $validatedrequest = $request->validate([
            'copyrightyear' => ['required', 'integer'],
            'phonenumber' => ['required', 'string', 'max:30'],
            'emailaddress' => ['required', 'email', 'max:30'],
            'businessname' => ['required', 'string', 'max:30'],
            'housenumber' => ['nullable', 'string', 'max:30'],
            'streetname' => ['nullable', 'string', 'max:30'],
            'town' => ['nullable', 'string', 'max:30'],
            'county' => ['nullable', 'string', 'max:30'],
            'postcode' => ['nullable', 'string', 'max:30'],
            'image1' => ['mimes:jpeg,jpg,bmp,gif,png,tif', 'max:4000'],
            'showimage1' => ['boolean'],
            'emailnotifications' => ['required', 'email', 'max:50'],
        ]);

        // If a file is true, process it.
        if ($request->file('image1')) {
            $file = $request->file('image1');   //Assign file to $file variable.
            $destination = 'Images/uploaded'.'/';   //set up the destination.
            $ext = $file->getClientOriginalExtension(); //get the end of the extension.
            $originalName = $request->file('image1')->getClientOriginalName();  //Get the original name.
            $withOutExtension = pathinfo($originalName, PATHINFO_FILENAME);  // Get the name of the file without the extension.
            $mainFilename = $withOutExtension.'_'.date('h-i-s').'_'.Str::random(5);     // Create a special file name to help prevent the possibility of a clash in file title.
            $file->move($destination, $mainFilename.".".$ext);  // Move the file to specific folder and title the file to have the special name.
            $image1 = $mainFilename.".".$ext;   // Assign a string name to the $image1 variable that will be passed to the DB for use later.
        }
        else{
            $image1 = $businessinfo->image1;    // If not, then assign the old name.
        }

        // Assign all and save.
        $businessinfo->copyrightyear = $request->copyrightyear;
        $businessinfo->phonenumber = $request->phonenumber;
        $businessinfo->emailaddress = $request->emailaddress;
        $businessinfo->businessname = $request->businessname;
        $businessinfo->housenumber = $request->housenumber;
        $businessinfo->streetname = $request->streetname;
        $businessinfo->town = $request->town;
        $businessinfo->county = $request->county;
        $businessinfo->postcode = $request->postcode;
        $businessinfo->image1 = $image1;
        $businessinfo->showimage1 = $request->showimage1;
        $businessinfo->emailnotifications = $request->emailnotifications;

        $businessinfo->save();

        return redirect()->route('home');
    }
}
