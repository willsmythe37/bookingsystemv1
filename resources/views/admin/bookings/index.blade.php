@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">
                <h2>All Current Bookings History</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if($bookings->count() == 0)
                    <h3>There are currently no bookings to view</h3>
                    @else

                    <table class="table table-sm table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Info</th>
                            <th scope="col">Timeslot</th>
                            <th scope="col">Equipment</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($bookings as $booking)
                          <tr>
                              <th scope="row">{{ $booking->id }}</th>
                              <td><strong>Name: </strong>{{ $booking->User->name }} {{ $booking->User->surname }}<br>
                                <strong>Band: </strong>{{ $booking->User->band }}<br>
                                <strong>Room: </strong>{{ $booking->Room->roomname }}
                            <br><strong>P: </strong><nobr><a href="tel:{{ $booking->User->phonenumber }}">{{ $booking->User->phonenumber }}</a></nobr><br><strong>E: </strong><nobr><a href="mailto:{{ $booking->User->email }}">{{ $booking->User->email }}</a></nobr></td>
                              <td>
                                <strong>Day:</strong> {{ date("l", strtotime($booking->Booking_start)) }}<br><strong>Start:</strong> {{ date("d-m-Y", strtotime($booking->Booking_start)) }}<br>{{ date("H:i", strtotime($booking->Booking_start)) }}<br>
                                <strong>End:</strong> {{ date("d-m-Y", strtotime($booking->Booking_end)) }}<br>{{ date("H:i", strtotime($booking->Booking_end)) }}<br>
                                <strong>Created: </strong> {{ date("d-m-Y H:i", strtotime($booking->created_at)) }}<br>
                                @if($booking->created_at != $booking->updated_at)
                                <strong>Updated: </strong> {{ date("d-m-Y H:i", strtotime($booking->updated_at)) }}<br>
                                @endif
                            </td>

                              <td><p>
                                @if($booking->Equip->guitarheadamount > 0)
                                    GtrHeads : {{ $booking->Equip->guitarheadamount}}<br>
                                @endif
                                @if($booking->Equip->guitarcabamount > 0)
                                    GtrCabs : {{ $booking->Equip->guitarcabamount}}<br>
                                @endif
                                @if($booking->Equip->guitarcomboamount > 0)
                                    GtrCombos : {{ $booking->Equip->guitarcomboamount}}<br>
                                @endif
                                @if($booking->Equip->bassheadamount > 0)
                                    BassHeads : {{ $booking->Equip->bassheadamount}}<br>
                                @endif
                                @if($booking->Equip->basscabamount > 0)
                                    BassCabs : {{ $booking->Equip->basscabamount}}<br>
                                @endif
                                @if($booking->Equip->basscomboamount > 0)
                                    BassCombos : {{ $booking->Equip->basscomboamount}}<br>
                                @endif
                                @if($booking->Equip->drumkitamount > 0)
                                    DrumKits : {{ $booking->Equip->drumkitamount}}<br>
                                @endif
                                @if($booking->Equip->cymbalsamount > 0)
                                    CymbalSets : {{ $booking->Equip->cymbalsamount}}<br>
                                @endif </p>
                                    </td>
                                    <td><p><strong>Room cost:</strong> £{{ $booking->Room->priceperhour}}<br>
                                        <strong>Hours: </strong> {{ $hours = (strtotime($booking->Booking_end) - strtotime($booking->Booking_start)) / 3600 }}<br>
                                        <strong>Room fee: </strong>£{{ number_format(($booking->Room->priceperhour * $hours), 2, '.', ' ')}}<br>
                                        <strong>Equipment fee: </strong> £{{ $booking->Equip->equiptotal }}<br>
                                        <strong>Total:</strong> £{{ $booking->Cost_of_booking}}</p>
                                        @if($booking->Payment_status == false && $booking->Booking_end < $CarbonTimeAndDate )
                                        <strong>Payment status:</strong><em><strong style="color:red"> OUTSTANDING</strong></em>
                                        @elseif($booking->Payment_status == false)
                                        <strong>Payment status:</strong><em><strong style="color:green"> AWAITING</strong></em>
                                        @else
                                        <strong>Payment status:</strong> <em><strong style="color:blue">RECEIVED</strong></em>
                                        @endif</td>
                                    <td><div class="btn-group-vertical btn-block">
                                        <a class="btn btn-secondary btn-sm"
                                            href="{{ route('admin.history.usershow', $booking->User->id) }}">Bookings</a>
                                            <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.bookings.edit', $booking) }}">Edit</a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('admin.bookings.show', $booking) }}">Delete</a></div></td>


                                @endforeach


                        </tbody>
                      </table>

                      <div class="pagination pagination-centered justify-content-center">
                      {{ $bookings->links() }}</div>
                      @endif
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>

                <hr>
        </div>

        <div class="col-sm-2 sidenav">
        </div>

    </div>
</div>
@endsection
