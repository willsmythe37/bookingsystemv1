@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
                <h1>Delete Selected History & Bookings</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif



                    <h5>You searched from <strong>'{{ date("d-m-Y H:i", strtotime($begin)) }}'</strong>, until <strong>'{{ date("d-m-Y H:i", strtotime($end)) }}'</strong>.</h5>
                    <br>


                    <p>Submit the form if you are certain you wish to delete this area of history & bookings. </p>
                    <br>
                <form id="range" action="{{ route('admin.history.nuclearout')}}" method="POST">
                    {{ method_field('POST')}}
                    @csrf



                        <div class="row">
                        <div class="input-group col-lg-6">
                            <input type="date"
                                value="{{ $datestart }}" id="Booking_start_date"
                                aria-label="Booking_start_date" name="Booking_start_date"
                                class="form-control  @error('Booking_start_date') is-invalid @enderror" required hidden>

                            @error('Booking_start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group col-lg-6">
                            <input type="time" value="{{ $timestart }}" id="Booking_start_time" aria-label="Booking_start_time"
                                name="Booking_start_time" class="form-control @error('Booking_start_time') is-invalid @enderror"
                                required hidden>
                            @error('Booking_start_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group col-lg-6">
                            <input type="date"
                                value="{{ $dateend }}" id="Booking_end_date"
                                aria-label="Booking_end_date" name="Booking_end_date"
                                class="form-control @error('Booking_end_date') is-invalid @enderror" required hidden>
                            @error('Booking_end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group col-lg-6">
                            <input type="time" value="{{ $timeend }}" id="Booking_end_time" aria-label="Booking_end_time"
                                name="Booking_end_time" class="form-control @error('Booking_end_time') is-invalid @enderror"
                                required hidden>
                            @error('Booking_end_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>

        <button type="submit" class="btn btn-warning btn-sm">Delete selected history AND bookings</button><a href="{{ route('admin.history.index') }}"><button type="button" class="btn btn-secondary btn-sm">Back to History</button></a>
        </form><br><hr>

        <table class="table table-sm table-light table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">User Details</th>
                <th scope="col">Info</th>
                <th scope="col">Costs</th>
                <th scope="col">TimeStamps</th>
              </tr>
            </thead>
            <tbody>
                @foreach($history as $h)
                <tr style="
                @if($h->Booking_end < $now)
                color: #747182;
                @endif
                ">
                    <th scope="row">{{ $h->Booking_id }}</th>
                    <td><strong>Booking ID: </strong>{{ $h->Booking_id }}<br>
                        <strong>User ID: </strong>{{ $h->User_id }}<br>
                        <strong>Name: </strong>{{ $h->name }} {{ $h->surname }}<br>
                        <strong>Band: </strong>{{ $h->band }}<br>
                        <strong>P: </strong><a href="tel:{{ $h->phonenumber }}">{{ $h->phonenumber }}</a><br>
                        <strong>E: </strong><a href="mailto:{{ $h->email }}">{{ $h->email }}</a></td>
                    <td><strong>Room: </strong>{{ $h->roomname }}<br>
                        @if((date("d-m-Y", strtotime($h->Booking_start)) == (date("d-m-Y", strtotime($h->Booking_end)))))
                        <strong>Day:</strong> {{ date("l", strtotime($h->Booking_start)) }}<br>
                        <strong>On: </strong>{{ date("d-m-Y", strtotime($h->Booking_start)) }}<br>
                        <strong>From: </strong>{{ date("H:i", strtotime($h->Booking_start)) }}<br>
                        <strong>To: </strong>{{ date("H:i", strtotime($h->Booking_end)) }}
                        @else
                        <strong>From: </strong>{{ date("d-m-Y H:i", strtotime($h->Booking_start)) }}<br>
                        <strong>To: </strong>{{ date("d-m-Y H:i", strtotime($h->Booking_end)) }}
                        @endif
                    </td>
                    <td><strong>Hours:</strong> {{ $hours = ((strtotime($h->Booking_end) - strtotime($h->Booking_start)) / 3600) }}<br>
                        <strong>Room Cost: </strong>£{{ $h->priceperhour }}<br>
                            <strong>Equip Cost:</strong> £{{ $h->equiptotal }}<br>
                                <strong>Full Total:</strong> £{{ $h->Cost_of_booking }}</td>
                    <td style="
                    @if($h->status == "DELETED") background-color: #ffd9dc; //RED
                    @elseif($h->status == "ACCOUNT-DELETED") background-color: #f5ddba; //ORANGE
                    @elseif($h->status == "UPDATED")
                    background-color: #d2ccfc;     //More PURPLE
                    @else
                    background-color: #d9ddff;  //PURPLE
                    @endif
                    "><strong>Status:</strong> {{ $h->status }}<br>
                        <strong>Created: </strong>{{ date("d-m-Y H:i", strtotime($h->wascreated_at)) }}<br>
                  @if($h->wascreated_at != $h->wasupdated_at)
                  <strong>Updated: </strong>{{ date("d-m-Y H:i", strtotime($h->wasupdated_at)) }}<br>
              @endif

              @if($h->Booking_end < $now)
                          <em><strong style="color:red">Booking ended</strong></em>
                          @elseif($h->Booking_start < $now && $h->Booking_end > $now)
                          <em><strong style="color:green">Booking in-progress</strong></em>
                          @else

                          <em><strong style="color:blue">Booking hasn't started</strong></em>
                          @endif

                          <br>
                          @if($h->Payment_status == false && $h->Booking_end < $now )
                          <strong>Payment status:</strong><em><strong style="color:red"> OUTSTANDING</strong></em>
                          @elseif($h->Payment_status == false)
                          <strong>Payment status:</strong><em><strong style="color:green"> AWAITING</strong></em>
                          @else
                          <strong>Payment status:</strong> <em><strong style="color:blue">RECEIVED</strong></em>
                          @endif
            </td>

                      </tr>
              @endforeach

            </tbody>
          </table>

          <br>

          <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back to Dashboard</button></a>
          <br>
          <hr>


        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
