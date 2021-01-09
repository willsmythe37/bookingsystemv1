<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MetaContent as MetaContent;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class MetaContentsController extends Controller
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
    public function edit(MetaContent $metacontent)
    {
        //
        return view('admin.metacontent.edit', compact('metacontent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetaContent $metacontent)
    {
        //
        $validatedrequest = $request->validate([
            'charset' => ['required', 'string', 'max:255'],
            'keywords' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'refresh' => ['required', 'string', 'max:255'],
            'viewport' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'customCSS' => [ 'max:14500'],
        ]);

        $metacontent->charset = $request->charset;
        $metacontent->keywords = $request->keywords;
        $metacontent->description = $request->description;
        $metacontent->author = $request->author;
        $metacontent->refresh = $request->refresh;
        $metacontent->viewport = $request->viewport;
        $metacontent->title = $request->title;
        $metacontent->customCSS = $request->customCSS;

        $metacontent->save();

        return redirect()->route('home');
    }

}
