<?php

use Illuminate\Support\Facades\Route;
use App\SiteContent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $sitecontent = SiteContent::where('id', 1)->first();
    return view('index', compact('sitecontent'));
})->name('index');

Auth::routes(['verify' => true]);

Route::namespace('User')->prefix('user')->name('user.')->middleware('auth')->group(function(){
Route::get('/edit/{user}', 'UserController@edit')->name('edit');
Route::post('/update/{user}', 'UserController@update')->name('update');
Route::get('/show/{user}', 'UserController@show')->middleware('verified')->name('show');
Route::post('/destroy/{user}', 'UserController@destroy')->middleware('verified')->name('destroy');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/bookinginfo', 'RoomController@bookinginfo')->name('bookinginfo');
Route::get('/aboutus', 'RoomController@aboutus')->name('aboutus');
Route::get('/howtofindus', 'RoomController@howtofindus')->name('howtofindus');
Route::get('/termsandconditions', 'RoomController@termsandconditions')->name('termsandconditions');
Route::get('/privacypolicy', 'RoomController@privacypolicy')->name('privacypolicy');
Route::get('/cookiepolicy', 'RoomController@cookiepolicy')->name('cookiepolicy');

Route::get('/room', 'RoomController@rooms')->name('room');
Route::get('/booking/{room}', 'RoomController@booking')->name('booking')->middleware('auth')->middleware('verified');


Route::get('/user/bookings/index/{user}', 'BookingController@mybookings')->name('user.bookings.index')->middleware('auth')->middleware('verified');
Route::get('/user/bookings/edit/{booking}', 'BookingController@useredit')->name('user.bookings.edit')->middleware('auth')->middleware('verified');
Route::post('/user/bookings/update/{booking}', 'BookingController@userupdate')->name('user.bookings.update')->middleware('auth')->middleware('verified');
Route::get('/user/bookings/show/{booking}', 'BookingController@usershow')->name('user.bookings.show')->middleware('auth')->middleware('verified');
Route::post('/user/bookings/destroy/{booking}', 'BookingController@userdestroy')->name('user.bookings.destroy')->middleware('auth')->middleware('verified');
Route::post('/user/bookings/paynow/{booking}', 'BookingController@paynow')->name('user.bookings.paynow')->middleware('auth')->middleware('verified');

Route::post('/bookingcreated', 'BookingController@bookingcreated')->name('bookingcreated')->middleware('auth')->middleware('verified');

Route::get('/events/{room}', 'RoomController@events')->middleware('auth')->middleware('verified');


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->middleware('verified')->group(function(){

    Route::resource('/users', 'UsersController', ['except' => ['create', 'store']]);
    Route::resource('/bookings', 'BookingsController', ['except' => ['create', 'store']]);
    Route::resource('/holidays', 'HolidaysController');
    Route::resource('/rooms', 'RoomsController');
    Route::resource('/weblinks', 'WeblinksController');
    Route::resource('/sitecontent', 'SiteContentsController', ['except' => ['create', 'store', 'show', 'destroy']]);
    Route::resource('/businessinfo', 'BusinessInfoController', ['except' => ['create', 'store', 'show', 'destroy', 'index']]);
    Route::resource('/businesshour', 'BusinessHourController', ['except' => ['create', 'store', 'show', 'destroy', 'index']]);
    Route::resource('/hireprice', 'HirePricesController', ['except' => ['create', 'store', 'show', 'destroy', 'index']]);
    Route::resource('/metacontent', 'MetaContentsController', ['except' => ['create', 'store', 'show', 'destroy', 'index']]);
    Route::resource('/calendar', 'CalendarController', ['except' => ['create', 'store','show', 'destroy', 'edit', 'update']]);
    Route::get('/calendar/events', 'CalendarController@events')->middleware('auth')->name('calendar.events');

    Route::get('/display', 'AdminController@display')->middleware('auth')->name('display');
    Route::get('/mailinglist', 'AdminController@mailinglist')->middleware('auth')->name('mailinglist');

    Route::get('/history/index', 'HistoryController@index')->middleware('auth')->name('history.index');
    Route::get('/history/usershow/{user}', 'HistoryController@usershow')->middleware('auth')->name('history.usershow');
    Route::get('/history/search', 'HistoryController@search')->middleware('auth')->name('history.search');
    Route::get('/history/range', 'HistoryController@range')->middleware('auth')->name('history.range');
    Route::get('/history/clearup', 'HistoryController@clearup')->middleware('can:manage-system')->name('history.clearup');
    Route::get('/history/clearupshow', 'HistoryController@clearupshow')->middleware('can:manage-system')->name('history.clearupshow');
    Route::post('/history/clearout', 'HistoryController@clearout')->middleware('can:manage-system')->name('history.clearout');
    Route::get('/history/nuclear', 'HistoryController@nuclear')->middleware('can:manage-system')->name('history.nuclear');
    Route::post('/history/nuclearout', 'HistoryController@nuclearout')->middleware('can:manage-system')->name('history.nuclearout');
});

Route::get('Booking-created/{booking?}', function ($booking = null) {
})->middleware('auth')->middleware('verified');
Route::get('Booking-updated/{booking?}', function ($booking = null) {
})->middleware('auth')->middleware('verified');
Route::get('Booking-deleted/{booking?}', function ($booking = null) {
})->middleware('auth')->middleware('verified');
