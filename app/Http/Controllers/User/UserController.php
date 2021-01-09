<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User as User;
use App\Booking as Booking;
use App\Equip as Equip;
use App\History as History;
use App\Role;
use Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    // THIS CONTROLLER IS USED TO ALLOW ALL USERS TO EDIT THEIR OWN USER ACCOUNT.
    // THERE ARE REDIRECTIONS IN PLACE SHOULD A USER TRY TO ACCESS A ACCOUNT THAT DOESN'T THAT WHICH IS CURRENTLY LOGGED IN.

    // IF A USER DELETES THEIR ACCOUNT, THEIR BOOKINGS ARE ALSO DELETED. HENCE WHY THE BOOKING 'STATUS' FIELD IN THE HISTORY TABLE IS UPDATED FOR ALL OF THEIR BOOKINGS SO WE STILL HAVE HISTORY OF THEIR BOOKINGS.

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */


    public function edit(User $user)
    {
        //
        if(Auth::user()->id != $user->id)
        return redirect()->route('home')->with('This is not your user account');
        else

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if(Auth::user()->id != $user->id)
        return redirect()->route('home')->with('This is not your user account');
        else

        $validatedrequest = $request->validate([
            'name' => ['required', 'string', 'max:25'],
            'surname' => ['required', 'string', 'max:35'],
            'band' => ['required', 'string', 'max:50'],
            'phonenumber' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,'.$user->id],
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->band = $request->band;
        $user->phonenumber = $request->phonenumber;
        if($user->email != $request->email){
            $user->email_verified_at = null;
        }
        $user->email = $request->email;
        $user->save();
        if($user->email_verified_at == null){
            $user->sendEmailVerificationNotification();
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        if(Auth::user()->id != $user->id)
        return redirect()->route('home');
        else

        return view('user.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if(Auth::user()->id != $user->id)
        return redirect()->route('home');
        else

        $history = History::where('user_id', '=', Auth::user()->id)->get();

        foreach($history as $h){
            $h->status = 'ACCOUNT-DELETED';
            $h->save();
        }

        $user->delete();

        return redirect()->route('index');
    }
}
