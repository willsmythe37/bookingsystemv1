@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-sm-8">
                <h1>My Booking History</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if($mybookings->count() == 0)
                    <h3>You have no bookings to view</h3>
                    @else
                    <p>User's can edit their bookings here.</p>
                    <p>Please be aware that:
                        <ul>
                            <li>User's can't edit or cancel a booking within 12 hours of its 'start time'@can('manage-users') <small style="color:red">(Administrators can)</small>@endcan.</li>
                            <li>User's can't have more than 4 future bookings at any one time @can('manage-users') <small style="color:red">(Administrators can)</small>@endcan.</li>
                            <li>User's can't schedule a booking in advance of 90 days @can('manage-users') <small style="color:red">(Administrators can)</small>@endcan.</li>
                            <li>User's can't schedule a booking outside of our business hours, or during a planned business holiday @can('manage-users') <small style="color:red">(Administrators can)</small>@endcan.</li>
                        </ul>
                    </p>
                    <p>Note: If you have pre-paid, but can't attend your scheduled session please contact <a href="{{ $businessinfo->emailaddress }}" class="text-muted">{{ $businessinfo->emailaddress }}</a> to reschedule, or arrange another booking.</p>
                    <table class="table table-sm table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Timeslot</th>
                            <th scope="col">Equipment</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($mybookings as $booking)
                          <tr style="
                            @if($booking->Booking_end < $CarbonDate)
                            color: #747182;
                            @endif
                            @if($booking->Payment_status == true)
                            background-color: #dddaeb; //GREY
                            @elseif($booking->Booking_end < $CarbonDate)
                            background-color: #ffd9dc; //RED
                            @else
                            background-color: #d9ddff; //PURPLE
                            @endif">
                              <th scope="row">{{ $booking->id }}</th>
                              <td><strong>Room:</strong> <nobr>{{ $booking->Room->roomname }}</nobr><br>

                                @if(date("d-m-Y", strtotime($booking->Booking_start)) == date("d-m-Y", strtotime($booking->Booking_end)))
                                <strong>Day:</strong> {{ date("l", strtotime($booking->Booking_start)) }}<br>
                                <strong>Date:</strong> {{ date("d-m-Y", strtotime($booking->Booking_start)) }}<br>
                                  <strong>Start:</strong> {{ date("H:i", strtotime($booking->Booking_start)) }}<br>
                                <strong>End:</strong> {{ date("H:i", strtotime($booking->Booking_end)) }}<br>
                                @else
                                <strong>Day:</strong> {{ date("l", strtotime($booking->Booking_start)) }}<br>
                                <strong>Date Start:</strong> {{ date("d-m-Y", strtotime($booking->Booking_start)) }}<br>
                                <strong>Date End:</strong> {{ date("d-m-Y", strtotime($booking->Booking_end)) }}<br>
                                  <strong>Time Start:</strong> {{ date("H:i", strtotime($booking->Booking_start)) }}<br>
                                <strong>Time End:</strong> {{ date("H:i", strtotime($booking->Booking_end)) }}<br>
                                @endif

                                <strong>Hours: </strong> {{ $hours = (strtotime($booking->Booking_end) - strtotime($booking->Booking_start)) / 3600 }}<br>

                                <strong>Created: </strong> {{ date("d-m-Y H:i", strtotime($booking->created_at)) }}<br>
                                @if($booking->created_at != $booking->updated_at)
                                <strong>Updated: </strong> {{ date("d-m-Y H:i", strtotime($booking->updated_at)) }}<br>
                                @endif
                              <td>
                                @if($booking->Equip->guitarheadamount > 0)
                                    <strong>GtrHeads :</strong> {{ $booking->Equip->guitarheadamount}}<br>
                                @endif
                                @if($booking->Equip->guitarcabamount > 0)
                                    <strong>GtrCabs :</strong> {{ $booking->Equip->guitarcabamount}}<br>
                                @endif
                                @if($booking->Equip->guitarcomboamount > 0)
                                    <strong>GtrCombos :</strong> {{ $booking->Equip->guitarcomboamount}}<br>
                                @endif
                                @if($booking->Equip->bassheadamount > 0)
                                    <strong>BassHeads :</strong> {{ $booking->Equip->bassheadamount}}<br>
                                @endif
                                @if($booking->Equip->basscabamount > 0)
                                    <strong>BassCabs :</strong> {{ $booking->Equip->basscabamount}}<br>
                                @endif
                                @if($booking->Equip->basscomboamount > 0)
                                    <strong>BassCombos :</strong> {{ $booking->Equip->basscomboamount}}<br>
                                @endif
                                @if($booking->Equip->drumkitamount > 0)
                                    <strong>DrumKits :</strong> {{ $booking->Equip->drumkitamount}}<br>
                                @endif
                                @if($booking->Equip->cymbalsamount > 0)
                                    <strong>CymbalSets :</strong> {{ $booking->Equip->cymbalsamount}}<br>
                                @endif
                                    </td>
                                    <td><strong>Room cost:</strong> £{{ $booking->Room->priceperhour}} <br>
                                        <strong>Room fee: </strong>£{{ number_format((float)($booking->Room->priceperhour * $hours), 2, '.', '')}} <br>
                                        <strong>Equipment fee:</strong> £{{ $booking->Equip->equiptotal }} <br>
                                        <strong>Total:</strong> £{{ $booking->Cost_of_booking}} <br>
                                        @if($booking->Booking_end < $CarbonDate)
                                        <em><strong style="color:red">Booking ended</strong></em><br>
                                        @elseif($booking->Booking_start < $CarbonDate && $booking->Booking_end > $CarbonDate)
                                        <em><strong style="color:green">Booking in-progress</strong></em><br>
                                        @else
                                        <em><strong style="color:blue">Booking hasn't started</strong></em><br>
                                        @endif

                                    @if($booking->Payment_status == false && $booking->Booking_end < $CarbonDate )
                                    <strong>Payment status:</strong><em><strong style="color:red"> OUTSTANDING</strong></em>
                                    @elseif($booking->Payment_status == false)
                                    <strong>Payment status:</strong><em><strong style="color:green"> AWAITING</strong></em>
                                    @else
                                    <strong>Payment status:</strong> <em><strong style="color:blue">RECEIVED</strong></em>
                                    @endif</td>
                                    <td>
                                        <div class="btn-group-vertical">
                                            <form id="BookingForm" action="{{ route('user.bookings.paynow', $booking) }}" method="post">
                                                {{ method_field('post')}}
                                                @csrf
                                            <button type="submit" class="btn btn-block btn-secondary btn-sm"
                                            @if($booking->status == "DELETED" || $booking->status == "ACCOUNT-DELETED" || $booking->Payment_status == 1 )
                                            disabled="disabled"
                                            @endif
                                                >@if($booking->Payment_status == 0)Pay-now @else - Paid - @endif</button></form>
                                            <a class="btn btn-primary btn-sm @if($booking->status == "DELETED" || $booking->status == "ACCOUNT-DELETED" || $booking->Payment_status == 1 || $CarbonDate > date("Y-m-d H:i", strtotime('-12 hours',strtotime($booking->Booking_start))) ) @if($booking->User->hasrole('Super Admin') || $booking->User->hasrole('Admin') ) @else disabled @endif @endif"
                                                href="{{ route('user.bookings.edit', $booking->id) }}">Edit</a>
                                            <a class="btn btn-warning btn-sm @if($booking->status == "DELETED" || $booking->status == "ACCOUNT-DELETED" || $booking->Payment_status == 1 || $CarbonDate > date("Y-m-d H:i", strtotime('-12 hours',strtotime($booking->Booking_start))) ) @if($booking->User->hasrole('Super Admin') || $booking->User->hasrole('Admin') ) @else disabled @endif @endif"
                                                href="{{ route('user.bookings.show', $booking->id) }}">Delete</a></div>
                                    </td>


                                @endforeach


                        </tbody>
                      </table>

                      <div class="pagination pagination-centered justify-content-center">
                        {{ $mybookings->links() }}</div>
                      @endif
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
<hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
