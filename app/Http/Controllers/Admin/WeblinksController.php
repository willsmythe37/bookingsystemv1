<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Weblink;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class WeblinksController extends Controller
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
        $weblinks = Weblink::orderBy('order')->paginate(8);


        return view('admin.weblinks.index', compact('weblinks'));
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

        return view('admin.weblinks.create');
    }

    public function store(Request $request)
    {
        //
        $validatedrequest = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'shortdescription' => ['required', 'string', 'max:500'],
            'webURL' => ['required', 'string', 'max:1000'],
            'order' => ['required', 'numeric', 'min:0'],
        ]);

        $weblink = Weblink::create([
            'name' => $request['name'],
            'shortdescription' => $request['shortdescription'],
            'webURL' => $request['webURL'],
            'order' => $request['order'],
        ]);

        return redirect()->route('admin.weblinks.index');
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Weblink $weblink)
    {
        //

        return view('admin.weblinks.show', compact('weblink'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Weblink $weblink)
    {
        //

        return view('admin.weblinks.edit', compact('weblink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weblink $weblink)
    {
        //
        $validatedrequest = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'shortdescription' => ['required', 'string', 'max:500'],
            'webURL' => ['required', 'string', 'max:1000'],
            'order' => ['required', 'numeric', 'min:0'],
        ]);

        $weblink->name = $request->name;
        $weblink->shortdescription = $request->shortdescription;
        $weblink->webURL = $request->webURL;
        $weblink->order = $request->order;
        $weblink->save();

        return redirect()->route('admin.weblinks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weblink $weblink)
    {
        //
        $weblink->delete();

        return redirect()->route('admin.weblinks.index');
    }
}
