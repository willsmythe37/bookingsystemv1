@extends('layouts.app')

@section('content')

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-sm-8 text-left">

            <h1>Editing Selected Booking</h1>
            <br>
            <div class="row">
                <div class="col-md-4">
            <p><strong>Booking ID:</strong> {{ $booking->id }}<br>
                <strong>User ID:</strong> {{ $booking->User->id }}<br>
                    <strong>Name:</strong> {{ $booking->User->name }} {{ $booking->User->surname }}<br>
                        <strong>Band: </strong>{{ $booking->User->band }}<br>
                            <strong>Email:</strong> {{ $booking->User->email }}</p>
            </div>
            <div class="col-md-4">
            <p><strong>Room ID: </strong>{{ $booking->Room->id }}<br>
                <strong>Room Name: </strong>{{ $booking->Room->roomname }}<br>
                <strong>From:</strong> {{ date("d-m-Y H:i", strtotime($booking->Booking_start)) }}<br>
                    <strong>Until:</strong> {{ date("d-m-Y H:i", strtotime($booking->Booking_end)) }}</p>
            </div>
            <div class="col-md-4">
            <p><strong>Hours:</strong> {{ $hours = ((strtotime($booking->Booking_end) - strtotime($booking->Booking_start)) / 3600) }}<br>
                <strong>Room Cost Per Hour: </strong>£{{ $booking->Room->priceperhour }}<br>
                    <strong>Equip Cost:</strong> £{{ $booking->Equip->equiptotal }}<br>
                        <strong>Full Total:</strong> £{{ $booking->Cost_of_booking }}</p>
            </div>
        </div>
            <hr>

            @if(session()->has('Booking_query_error'))
        <div class="alert alert-danger">
            <h3>Problem with booking update</h3>
            {{ session()->get('Booking_query_error') }}
        </div>
        <hr>
        @endif

            <form id="BookingForm" action="{{ route('user.bookings.update', $booking) }}" method="post">
                {{ method_field('POST')}}
                <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Start date</span>
                    </label>
                    <input type="text" readonly="true"
                        value="{{ old('Booking_start_date') ? old('Booking_start_date') : date("Y-m-d", strtotime($booking->Booking_start)) }}" id="Booking_start_date"
                        aria-label="Booking_start_date" name="Booking_start_date"
                        class="form-control  @error('Booking_start_date') is-invalid @enderror" required>

                    @error('Booking_start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Start time</span>
                    </label>
                    <input type="text"  readonly="true" value="{{ old('Booking_start_time') ? old('Booking_start_time') : date("H:i", strtotime($booking->Booking_start)) }}" step="1800" id="Booking_start_time" aria-label="Booking_start_time"
                        name="Booking_start_time" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Booking_start_time') is-invalid @enderror"
                        required>
                    @error('Booking_start_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">End date</span>
                    </label>
                    <input type="text" readonly="true"
                        value="{{ old('Booking_end_date') ? old('Booking_end_date') : date("Y-m-d", strtotime($booking->Booking_end)) }}" id="Booking_end_date"
                        aria-label="Booking_end_date" name="Booking_end_date"
                        class="form-control @error('Booking_end_date') is-invalid @enderror" required>
                    @error('Booking_end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">End time</span>
                    </label>
                    <input type="text"  readonly="true" value="{{ old('Booking_end_time') ? old('Booking_end_time') : date("H:i", strtotime($booking->Booking_end)) }}" step="1800" id="Booking_end_time" aria-label="Booking_end_time"
                        name="Booking_end_time" pattern="[0-9]:[0-9]" class="form-control @error('Booking_end_time') is-invalid @enderror"
                        required>
                    @error('Booking_end_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="hidden" id="Room_id" name="Room_id" class="form-control"
                        value="{{ $booking->Room->id }}" />
                    <input type="hidden" id="User_id" name="User_id" class="form-control"
                        value="{{ $booking->User->id }}" />
                </div>
            </div>
            <hr>
            <h3>Select addition equipment you wish to hire</h3>
            <div class="form-group row">
                <label  class="col-md-2 col-form-label text-md-right">{{ __('Guitar Head') }}</label>

                <div class="col-md-2">
                    <input id="guitarheadamount" type="text" step="1" class="addpadding form-control @error('guitarheadamount') is-invalid @enderror" readonly="true"
                        name="guitarheadamount" value="{{ old('guitarheadamount') ? old('guitarheadamount') : $booking->Equip->guitarheadamount }}" required autocomplete="guitarheadamount">

                    @error('guitarheadamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label class="col-md-2 col-form-label text-md-right">{{ __('Guitar Cab') }}</label>

                <div class="col-md-2">
                    <input id="guitarcabamount" type="text" step="1" class="addpadding form-control @error('guitarcabamount') is-invalid @enderror" readonly="true"
                        name="guitarcabamount" value="{{ old('guitarcabamount') ? old('guitarcabamount') : $booking->Equip->guitarcabamount }}" required autocomplete="guitarcabamount">

                    @error('guitarcabamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label class="col-md-2 col-form-label text-md-right">{{ __('Guitar Combos') }}</label>

                <div class="col-md-2">
                    <input id="guitarcomboamount" type="text" step="1" class="addpadding form-control @error('guitarcomboamount') is-invalid @enderror" readonly="true"
                        name="guitarcomboamount" value="{{ old('guitarcomboamount') ? old('guitarcomboamount') : $booking->Equip->guitarcomboamount }}" required autocomplete="guitarcomboamount">

                    @error('guitarheadamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label text-lg-right">{{ __('Bass Head') }}</label>

                <div class="col-lg-2">
                    <input id="bassheadamount" type="text" step="1" class="addpadding form-control @error('bassheadamount') is-invalid @enderror" readonly="true"
                        name="bassheadamount" value="{{ old('bassheadamount') ? old('bassheadamount') : $booking->Equip->bassheadamount }}" required autocomplete="bassheadamount">

                    @error('bassheadamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label class="col-lg-2 col-form-label text-lg-right">{{ __('Bass Cab') }}</label>

                <div class="col-lg-2">
                    <input id="basscabamount" type="text" step="1" class="addpadding form-control @error('basscabamount') is-invalid @enderror" readonly="true"
                        name="basscabamount" value="{{ old('basscabamount') ? old('basscabamount') : $booking->Equip->basscabamount }}" required autocomplete="basscabamount">

                    @error('basscabamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label class="col-lg-2 col-form-label text-lg-right">{{ __('Bass Combos') }}</label>

                <div class="col-lg-2">
                    <input id="basscomboamount" type="text" step="1" class="addpadding form-control @error('basscomboamount') is-invalid @enderror" readonly="true"
                        name="basscomboamount" value="{{ old('basscomboamount') ? old('basscomboamount') : $booking->Equip->basscomboamount }}" required autocomplete="basscomboamount">

                    @error('basscomboamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-2 col-form-label text-lg-right">{{ __('Drum Kit') }}</label>

                <div class="col-lg-2">
                    <input id="drumkitamount" type="text" step="1" class="addpadding form-control @error('drumkitamount') is-invalid @enderror" readonly="true"
                        name="drumkitamount" value="{{ old('drumkitamount') ? old('drumkitamount') : $booking->Equip->drumkitamount }}" required autocomplete="drumkitamount">

                    @error('drumkitamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror


                </div>
                <label class="col-lg-2 col-form-label text-lg-right">{{ __('Cymbals') }}</label>

                <div class="col-lg-2">
                    <input id="cymbalsamount" type="text" step="1" class="addpadding form-control @error('cymbalsamount') is-invalid @enderror" readonly="true"
                        name="cymbalsamount" value="{{ old('cymbalsamount') ? old('cymbalsamount') : $booking->Equip->cymbalsamount }}" required autocomplete="cymbalsamount">

                    @error('cymbalsamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror


                </div>
            </div><hr>

                <button type="Submit" class="btn btn-primary btn-sm">Edit Booking</button>
                <a href="{{ route('user.bookings.index', Auth::user()) }}"><button type="button" class="btn btn-secondary btn-sm">Back to My Bookings</button></a>
                @csrf
            </form><hr>


        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>

@endsection
