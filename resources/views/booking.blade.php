@extends('layouts.app')

@section('content')

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8 text-left">

            @if($selectedroom->available == 0)





            <h1>Sorry {{ $selectedroom->roomname }} is unavailable</h1>

            <p>This can be for many reasons such as:<br>
                <ul>
                    <li>This is a newly created space and we haven't finished setting it up.</li>
                    <li>It's undergoing scheduled maintenance.</li>
                    <li>The room is being decomissioned for a short time.</li>
                </ul>
                If you have already made a booking for the space, consider it to still be <strong>active</strong> unless you have been notified by an administrator.</P>

                <div class="btn-group btn-block">
                    @foreach($allrooms as $a)
                    @if($a == $selectedroom)
                    <a type="button" class="btn btn-warning" href="{{ route('booking', $a) }}">{{ $a->roomname }}</a>
                    @else
                    <a type="button" class="btn btn-info" href="{{ route('booking', $a) }}">{{ $a->roomname }}</a>
                    @endif
                    @endforeach
                    @can('manage-users')
                    <a type="button" class="btn btn-info" href="{{ route('admin.calendar.index')}}">All</a>
                    @endcan
                </div>
                <br>
                <br>
                <a href="{{ route('room') }}"><button type="button" class="btn btn-secondary btn-sm">Back to 'Rooms available'</button></a><br>
            @else

            <h1>Create booking for {{ $selectedroom->roomname }} </h1>
            {{-- <p>Current Bookings</p>
            @foreach($selectedroomsbookings as $booking)
            <p> Name: {{ $booking->user->name }} {{ $booking->user->surname }} /// Band: {{ $booking->user->band }}
                /// Date: {{$booking->Booking_start_date}} - Start: {{$booking->Booking_start_time}}
                End: {{$booking->Booking_end_time}}</p>
            @endforeach --}}
            <hr>
            <div class="row">
                @if($selectedroom->showimage1 == false)
                <div class="col-lg-12">
                    <h3>Room description</h3>
                    <p>{{  $selectedroom->longdescription }}<br></p>
                    <p>The price of this room is £{{ $selectedroom->priceperhour }} per hour.</p>
                    </div>
                    @else
                    <div class="col-lg-8">
                        <h3>Room description</h3>
                        <p>{{  $selectedroom->longdescription }}<br></p>
                        <p>The price of this room is £{{ $selectedroom->priceperhour }} per hour.</p>
                        </div>
                        <div class="col-lg-4">
                            <img src="/Images/uploaded/{{$selectedroom->image1}}" style="padding: 20px 20px 20px 20px;" alt="{{$selectedroom->image1}}"
                                class="img-fluid rounded">
                        </div>





        </div>


        @if(session()->has('Booking_query_error'))
        <div class="alert alert-danger">
            Unfortunatly there was an issue with your request. Please see the form below for more information.
        </div>
        @endif



            <hr>

            <div id="app">
                <br>
                <example-component></example-component>
            </div>

            <br>
            <div class="btn-group btn-block">
                @foreach($allrooms as $a)
                @if($a == $selectedroom)
                <a type="button" class="btn btn-warning" href="{{ route('booking', $a) }}">{{ $a->roomname }}</a>
                @else
                <a type="button" class="btn btn-info" href="{{ route('booking', $a) }}">{{ $a->roomname }}</a>
                @endif
                @endforeach
                @can('manage-users')
                <a type="button" class="btn btn-info" href="{{ route('admin.calendar.index')}}">All</a>
                @endcan
            </div>
            <p id="demo"></p>
            @endif





        <hr>


        @if(session()->has('Booking_query_error'))
        <div class="alert alert-danger">
            <h3>Problem with chosen booking</h3>
            {{ session()->get('Booking_query_error') }}
        </div>
        <hr>
        @endif
            <h3>Select the date and times you require</h3>

            <form id="BookingForm" action="/bookingcreated" method="post">
                <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Start date</span>
                    </label>
                    <input type="text" min="{{ $CarbonTimeAndDate->toDateString() }}"
                        value="{{ old('Booking_start_date') ? old('Booking_start_date') : $CarbonTimeAndDate->toDateString()}}" id="Booking_start_date"
                        aria-label="Booking_start_date" name="Booking_start_date" readonly="true"
                        class="form-control @error('Booking_start_date') is-invalid @enderror"  required>

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
                    <input type="text" value="{{ old('Booking_start_time') ? old('Booking_start_time') : "12:00" }}" step="1800" id="Booking_start_time" aria-label="Booking_start_time"
                        name="Booking_start_time" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Booking_start_time') is-invalid @enderror"readonly="true"
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
                    <input type="text" min="{{ $CarbonTimeAndDate->toDateString() }}"
                        value="{{ old('Booking_end_date') ? old('Booking_end_date') : $CarbonTimeAndDate->toDateString()}}" id="Booking_end_date"
                        aria-label="Booking_end_date" name="Booking_end_date" readonly="true"
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
                    <input type="text" value="{{ old('Booking_end_time') ? old('Booking_end_time') : "18:00" }}" step="1800" id="Booking_end_time" aria-label="Booking_end_time"
                        name="Booking_end_time" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Booking_end_time') is-invalid @enderror" readonly="true"
                        required>
                    @error('Booking_end_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="hidden" id="Room_id" name="Room_id" class="form-control"
                        value="{{ $selectedroom->id }}" />
                    <input type="hidden" id="User_id" name="User_id" class="form-control"
                        value="{{ auth::user()->id }}" />
                </div>

            </div>
            <hr>
            <h3>Select addition equipment you wish to hire</h3>
            <div class="form-group row">
                <label for="guitarheadamount" class="col-md-2 col-form-label text-md-right">{{ __('Guitar Head') }}</label>

                <div class="col-md-2">
                    <input id="guitarheadamount" type="text" step="1" class="addpadding form-control @error('guitarheadamount') is-invalid @enderror" readonly="true"
                        name="guitarheadamount" value="{{ old('guitarheadamount') ? old('guitarheadamount') : "0" }}" min="0" max="15" required autocomplete="guitarheadamount">

                    @error('guitarheadamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="guitarcabamount" class="col-md-2 col-form-label text-md-right">{{ __('Guitar Cab') }}</label>

                <div class="col-md-2">
                    <input id="guitarcabamount" type="text" step="1" class="addpadding form-control @error('guitarcabamount') is-invalid @enderror" readonly="true"
                        name="guitarcabamount" value="{{ old('guitarcabamount') ? old('guitarcabamount') : "0" }}" min="0" max="15" required autocomplete="guitarcabamount">

                    @error('guitarcabamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="guitarcomboamount" class="col-md-2 col-form-label text-md-right">{{ __('Guitar Combos') }}</label>

                <div class="col-md-2">
                    <input id="guitarcomboamount" type="text" step="1" class="addpadding form-control @error('guitarcomboamount') is-invalid @enderror" readonly="true"
                        name="guitarcomboamount" value="{{ old('guitarcomboamount') ? old('guitarcomboamount') : "0" }}" min="0" max="15" required autocomplete="guitarcomboamount">

                    @error('guitarheadamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="bassheadamount" class="col-md-2 col-form-label text-md-right">{{ __('Bass Head') }}</label>

                <div class="col-md-2">
                    <input id="bassheadamount" type="text" step="1" class="addpadding form-control @error('bassheadamount') is-invalid @enderror" readonly="true"
                        name="bassheadamount" value="{{ old('bassheadamount') ? old('bassheadamount') : "0" }}" min="0" max="15" required autocomplete="bassheadamount">

                    @error('bassheadamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="basscabamount" class="col-md-2 col-form-label text-md-right">{{ __('Bass Cab') }}</label>

                <div class="col-md-2">
                    <input id="basscabamount" type="text" step="1" class="addpadding form-control @error('basscabamount') is-invalid @enderror" readonly="true"
                        name="basscabamount" value="{{ old('basscabamount') ? old('basscabamount') : "0" }}" min="0" max="15" required autocomplete="basscabamount">

                    @error('basscabamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="basscomboamount" class="col-md-2 col-form-label text-md-right">{{ __('Bass Combos') }}</label>

                <div class="col-md-2">
                    <input id="basscomboamount" type="text" step="1" class="addpadding form-control @error('basscomboamount') is-invalid @enderror" readonly="true"
                        name="basscomboamount" value="{{ old('basscomboamount') ? old('basscomboamount') : "0" }}" min="0" max="15" required autocomplete="basscomboamount">

                    @error('basscomboamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="drumkitamount" class="col-md-2 col-form-label text-md-right">{{ __('Drum Kit') }}</label>

                <div class="col-md-2">
                    <input id="drumkitamount" type="text" step="1" class="addpadding form-control @error('drumkitamount') is-invalid @enderror" readonly="true"
                        name="drumkitamount" value="{{ old('drumkitamount') ? old('drumkitamount') : "0" }}" min="0" max="15" required autocomplete="drumkitamount">

                    @error('drumkitamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror


                </div>
                <label for="cymbalsamount" class="col-md-2 col-form-label text-md-right">{{ __('Cymbals') }}</label>

                <div class="col-md-2">
                    <input id="cymbalsamount" type="text" step="1" class="addpadding form-control @error('cymbalsamount') is-invalid @enderror" readonly="true"
                        name="cymbalsamount" value="{{ old('cymbalsamount') ? old('cymbalsamount') : "0" }}" min="0" max="15" required autocomplete="cymbalsamount">

                    @error('cymbalsamount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror


                </div>
            </div>
            <br>

                <button type="Submit" class="btn btn-primary btn-sm">Create Booking</button>
                <a href="{{ route('room') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                @csrf
            </form>




            <div id="app">
                <br>
                <datepicker-component></datepicker-component>
            </div>
            @endif
            <hr>


        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
</div>



@endsection
