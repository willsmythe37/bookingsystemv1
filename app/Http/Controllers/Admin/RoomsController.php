<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomsController extends Controller
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
        $rooms = Room::paginate(8);

        return view('admin.rooms.index', compact('rooms'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        //
        $validatedrequest = $request->validate([
            'roomname' => ['required', 'string', 'max:50'],
            'shortdescription' => ['required', 'string', 'max:255'],
            'longdescription' => ['required', 'string', 'max:1000'],
            'priceperhour' => ['required', 'numeric'],
            'available' => ['boolean'],
            'image1' => ['mimes:jpeg,jpg,bmp,gif,png,tif', 'max:1000'],
            'showimage1' => ['boolean'],
        ]);

        if ($request->file('image1')) {
            $file = $request->file('image1');
            $destination = 'Images/uploaded'.'/';
            $ext = $file->getClientOriginalExtension();
            $originalName = $request->file('image1')->getClientOriginalName();
            $withOutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            $mainFilename = $withOutExtension.'_'.date('h-i-s').'_'.Str::random(5);
            $file->move($destination, $mainFilename.".".$ext);
            $image1 = $mainFilename.".".$ext;
        }
        else{
            $image1 = 'CB1.jpg';
        }

        $room = Room::create([
            'roomname' => $request['roomname'],
            'shortdescription' => $request['shortdescription'],
            'longdescription' => $request['longdescription'],
            'priceperhour' => $request['priceperhour'],
            'available' => $request['available'],
            'image1' => $image1,
            'showimage1' => $request['showimage1'],
        ]);

        return redirect()->route('admin.rooms.index');
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //

        return view('admin.rooms.show', compact('room'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //

        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
        $validatedrequest = $request->validate([
            'roomname' => ['required', 'string', 'max:50'],
            'shortdescription' => ['required', 'string', 'max:255'],
            'longdescription' => ['required', 'string', 'max:1000'],
            'priceperhour' => ['required', 'numeric'],
            'available' => ['boolean'],
            'image1' => ['mimes:jpeg,jpg,bmp,gif,png,tif', 'max:1000'],
            'showimage1' => ['boolean'],
        ]);

        if ($request->file('image1')) {
            $file = $request->file('image1');
            $destination = 'Images/uploaded'.'/';
            $ext = $file->getClientOriginalExtension();
            $originalName = $request->file('image1')->getClientOriginalName();
            $withOutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            $mainFilename = $withOutExtension.'_'.date('h-i-s').'_'.Str::random(5);
            $file->move($destination, $mainFilename.".".$ext);
            $image1 = $mainFilename.".".$ext;
        }
        else{
            $image1 = $room->image1;
        }

        $room->roomname = $request->roomname;
        $room->shortdescription = $request->shortdescription;
        $room->longdescription = $request->longdescription;
        $room->priceperhour = $request->priceperhour;
        $room->available = $request->available;
        $room->image1 = $image1;
        $room->showimage1 = $request->showimage1;
        $room->save();

        return redirect()->route('admin.rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
        $room->delete();

        return redirect()->route('admin.rooms.index');
    }
}
