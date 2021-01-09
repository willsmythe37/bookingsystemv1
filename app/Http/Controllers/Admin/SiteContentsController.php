<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SiteContent as SiteContent;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class SiteContentsController extends Controller
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
        $sitecontents = SiteContent::paginate(8);

        return view('admin.sitecontent.index', compact('sitecontents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteContent $sitecontent)
    {
        //
        return view('admin.sitecontent.edit', compact('sitecontent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteContent $sitecontent)
    {
        //
        $validatedrequest = $request->validate([
            'pagename' => ['required', 'string', 'max:255'],
            'title1' => ['nullable', 'string', 'max:255'],
            'body1' => ['nullable', 'string', 'max:10000'],
            'show1' => ['boolean'],
            'image1' => ['mimes:jpeg,jpg,bmp,gif,png,tif', 'max:4000'],
            'showimage1' => ['boolean'],
            'title2' => ['nullable', 'string', 'max:255'],
            'body2' => ['nullable', 'string', 'max:10000'],
            'show2' => ['boolean'],
            'image2' => ['mimes:jpeg,jpg,bmp,gif,png,tif', 'max:4000'],
            'showimage2' => ['boolean'],
            'title3' => ['nullable', 'string', 'max:255'],
            'body3' => ['nullable', 'string', 'max:10000'],
            'show3' => ['boolean'],
            'image3' => ['mimes:jpeg,jpg,bmp,gif,png,tif', 'max:4000'],
            'showimage3' => ['boolean'],
        ]);

        if ($request->file('image1')) {
                $file = $request->file('image1');
                $destination = 'Images/uploaded'.'/';
                $ext = $file->getClientOriginalExtension();
                $originalName = $request->file('image1')->getClientOriginalName();
                $withOutExtension = pathinfo($originalName, PATHINFO_FILENAME);
                $mainFilename = $withOutExtension.'_'.date('h-i-s').'_'.Str::random(5);
                $file->move($destination, $mainFilename.".".$ext);
                $sitecontent->image1 = $mainFilename.".".$ext;
        }

        if ($request->file('image2')) {
                $file = $request->file('image2');
                $destination = 'Images/uploaded'.'/';
                $ext = $file->getClientOriginalExtension();
                $originalName = $request->file('image2')->getClientOriginalName();
                $withOutExtension = pathinfo($originalName, PATHINFO_FILENAME);
                $mainFilename = $withOutExtension.'_'.date('h-i-s').'_'.Str::random(5);
                $file->move($destination, $mainFilename.".".$ext);
                $sitecontent->image2 = $mainFilename.".".$ext;

        }

        if ($request->file('image3')) {
            $file = $request->file('image3');
            $destination = 'Images/uploaded'.'/';
            $ext = $file->getClientOriginalExtension();
            $originalName = $request->file('image3')->getClientOriginalName();
            $withOutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            $mainFilename = $withOutExtension.'_'.date('h-i-s').'_'.Str::random(5);
            $file->move($destination, $mainFilename.".".$ext);
            $sitecontent->image3 = $mainFilename.".".$ext;
        }


        $sitecontent->pagename = $request->pagename;
        $sitecontent->title1 = $request->title1;
        $sitecontent->body1 = $request->body1;
        $sitecontent->show1 = $request->show1;
        $sitecontent->showimage1 = $request->showimage1;
        $sitecontent->title2 = $request->title2;
        $sitecontent->body2 = $request->body2;
        $sitecontent->show2 = $request->show2;
        $sitecontent->showimage2 = $request->showimage2;
        $sitecontent->title3 = $request->title3;
        $sitecontent->body3 = $request->body3;
        $sitecontent->show3 = $request->show3;
        $sitecontent->showimage3 = $request->showimage3;

        $sitecontent->save();

        return redirect()->route('admin.sitecontent.index');
    }

}
