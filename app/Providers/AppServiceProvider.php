<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\BusinessInfo as BusinessInfo;
use App\BusinessHour as BusinessHour;
use App\MetaContent as MetaContent;
use App\HirePrice as HirePrice;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $businessinfo = BusinessInfo::find('1');
        $businesshour = BusinessHour::find('1');
       $sitemetadata = MetaContent::find('1');
       $hireprices = HirePrice::find('1');

       view()->composer('layouts.app', function($view) use ($businessinfo){
        $view->with('businessinfo',$businessinfo);
       });
        view()->composer('layouts.app', function($view) use ($businesshour){
        $view->with('businesshour',$businesshour);
       });
      view()->composer('layouts.app', function($view) use ($sitemetadata){
       $view->with('sitemetadata',$sitemetadata);
      });
      view()->composer('layouts.app', function($view) use ($hireprices){
        $view->with('hireprices',$hireprices);
       });

    }
}
