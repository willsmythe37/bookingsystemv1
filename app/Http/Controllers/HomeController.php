<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessInfo as BusinessInfo;
use App\SiteContent as SiteContent;
use App\MetaContent as MetaContent;
use App\HirePrice as HirePrice;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $businessinfo = BusinessInfo::find('1');
        $sitemetadata = MetaContent::find('1');
        $hireprices = HirePrice::find('1');
        $sitecontent = SiteContent::where('pagename', 'Home')->first();

        return view('home', compact('businessinfo', 'sitemetadata', 'hireprices', 'sitecontent'));
    }
}
