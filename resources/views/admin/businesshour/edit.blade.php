@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">
            <div>
                <h1>Edit Business hours</h1>
<p>Amend the selected business hours below. These will be referenced during the creation of bookings (Administrators are exempt).</p>
                    <p>Note: Due to implementation issues, the inclusion of 'business hours' functionality prevents users ever booking beyond 23:30. If an admin permits bookings of this sort, users could create a booking, then an admin could adjust the time slot manually.</p> <p> Also, setting both times to 00:00 results in no bookings being possible.</p>

            <form id="BookingForm" action="{{ route('admin.businesshour.update', $businesshour) }}" method="post">
                {{ method_field('PUT')}}
                @csrf

                <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Monday Start Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Mondaystart }}" step="1800" id="Mondaystart" aria-label="Mondaystart"
                        name="Mondaystart" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Mondaystart') is-invalid @enderror"
                        required>
                    @error('Mondaystart')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Monday End Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Mondayend }}" step="1800" id="Mondayend" aria-label="Mondayend"
                        name="Mondayend" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Mondayend') is-invalid @enderror"
                        required>
                    @error('Mondayend')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Tuesday Start Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Tuesdaystart }}" step="1800" id="Tuesdaystart" aria-label="Tuesdaystart"
                        name="Tuesdaystart" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Tuesdaystart') is-invalid @enderror"
                        required>
                    @error('Tuesdaystart')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Tuesday End Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Tuesdayend }}" step="1800" id="Tuesdayend" aria-label="Tuesdayend"
                        name="Tuesdayend" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Tuesdayend') is-invalid @enderror"
                        required>
                    @error('Tuesdayend')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Wednesday Start Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Wednesdaystart }}" step="1800" id="Wednesdaystart" aria-label="Wednesdaystart"
                        name="Wednesdaystart" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Wednesdaystart') is-invalid @enderror"
                        required>
                    @error('Wednesdaystart')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Wednesday End Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Wednesdayend }}" step="1800" id="Wednesdayend" aria-label="Wednesdayend"
                        name="Wednesdayend" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Wednesdayend') is-invalid @enderror"
                        required>
                    @error('Wednesdayend')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Thursday Start Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Thursdaystart }}" step="1800" id="Thursdaystart" aria-label="Thursdaystart"
                        name="Thursdaystart"  class="form-control @error('Thursdaystart') is-invalid @enderror"
                        required>
                    @error('Thursdaystart')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Thursday End Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Thursdayend }}" step="1800" id="Thursdayend" aria-label="Thursdayend"
                        name="Thursdayend" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Thursdayend') is-invalid @enderror"
                        required>
                    @error('Thursdayend')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Friday Start Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Fridaystart }}" step="1800" id="Fridaystart" aria-label="Fridaystart"
                        name="Fridaystart" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Fridaystart') is-invalid @enderror"
                        required>
                    @error('Fridaystart')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Friday End Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Fridayend }}" step="1800" id="Fridayend" aria-label="Fridayend"
                        name="Fridayend" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Fridayend') is-invalid @enderror"
                        required>
                    @error('Fridayend')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Saturday Start Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Saturdaystart }}" step="1800" id="Saturdaystart" aria-label="Saturdaystart"
                        name="Saturdaystart" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Saturdaystart') is-invalid @enderror"
                        required>
                    @error('Saturdaystart')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Saturday End Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Saturdayend }}" step="1800" id="Saturdayend" aria-label="Saturdayend"
                        name="Saturdayend" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Saturdayend') is-invalid @enderror"
                        required>
                    @error('Saturdayend')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Sunday Start Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Sundaystart }}" step="1800" id="Sundaystart" aria-label="Sundaystart"
                        name="Sundaystart" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Sundaystart') is-invalid @enderror"
                        required>
                    @error('Sundaystart')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Monday End Time</span>
                    </label>
                    <input type="text" value="{{  $businesshour->Sundayend }}" step="1800" id="Sundayend" aria-label="Sundayend"
                        name="Sundayend" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Sundayend') is-invalid @enderror"
                        required>
                    @error('Sundayend')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div><br>

            @if(session()->has('Booking_query_error'))
                <div class="alert alert-danger">
                    {{ session()->get('Booking_query_error') }}
                </div>
                @endif


                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                    </form><hr>
                </div>
            </div>
            <BH-timepicker-component></BH-timepicker-component>

            <div class="col-sm-2 sidenav">
            </div>

        </div>
    </div>
</div>
@endsection
