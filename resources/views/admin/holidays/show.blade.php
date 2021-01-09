@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">


            <h3>Delete Holiday</h3>

            <form id="BookingForm" action="{{ route('admin.holidays.destroy', $holiday) }}" method="post">
                {{ method_field('DELETE')}}
                @CSRF

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">{{ __('Holiday title') }}</label>

                    <div class="col-md-6">
                        <input id="Holiday_title" maxlength="255" type="text"
                            class="form-control @error('Holiday_title') is-invalid @enderror" name="Holiday_title"
                            value="{{  $holiday->Holiday_title }}" required autocomplete="Holiday_title" disabled>

                        @error('Holiday_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Start date</span>
                    </label>
                    <input type="date" min="{{ $CarbonTimeAndDate->toDateString() }}"
                        value="{{ old('Holiday_start_date') ? old('Holiday_start_date') : date("Y-m-d", strtotime($holiday->Holiday_start)) }}" id="Holiday_start_date"
                        aria-label="Holiday_start_date" name="Holiday_start_date"
                        class="form-control  @error('Holiday_start_date') is-invalid @enderror" required disabled>

                    @error('Holiday_start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">Start time</span>
                    </label>
                    <input type="time" value="{{ old('Holiday_start_time') ? old('Holiday_start_time') : date("H:i", strtotime($holiday->Holiday_start)) }}" step="1800" id="Holiday_start_time" aria-label="Holiday_start_time"
                        name="Holiday_start_time" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Holiday_start_time') is-invalid @enderror"
                        required disabled>
                    @error('Holiday_start_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">End date</span>
                    </label>
                    <input type="date" min="{{ $CarbonTimeAndDate->toDateString() }}"
                        value="{{ old('Holiday_end_date') ? old('Holiday_end_date') : date("Y-m-d", strtotime($holiday->Holiday_end)) }}" id="Holiday_end_date"
                        aria-label="Holiday_end_date" name="Holiday_end_date"
                        class="form-control @error('Holiday_end_date') is-invalid @enderror" required disabled>
                    @error('Holiday_end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group col-lg-6">
                    <label class="input-group-prepend">
                        <span class="input-group-text">End time</span>
                    </label>
                    <input type="time" value="{{ old('Holiday_end_time') ? old('Holiday_end_time') : date("H:i", strtotime($holiday->Holiday_end)) }}" step="1800" id="Holiday_end_time" aria-label="Holiday_end_time"
                        name="Holiday_end_time" pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Holiday_end_time') is-invalid @enderror"
                        required disabled>
                    @error('Holiday_end_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div><br>

            <button type="submit" class="btn btn-primary btn-sm">Delete</button>
            <a href="{{ route('admin.holidays.index') }}"><button type="button"
                    class="btn btn-secondary btn-sm">Back</button></a>
            </form><hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>

        </div>
        </div>

@endsection
