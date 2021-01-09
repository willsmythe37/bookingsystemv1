@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">

            <h1>Create Holiday</h1>

            <form id="holidayinfo" action="{{ route('admin.holidays.store')}}" method="POST">
                {{ method_field('POST')}}
                @csrf

                <div class="form-group row">
                    <label
                        class="col-md-3 col-form-label text-md-right">{{ __('Holiday title') }}</label>

                    <div class="col-md-6">
                        <input id="Holiday_title" maxlength="50" type="text"
                            class="form-control @error('Holiday_title') is-invalid @enderror" name="Holiday_title"
                            value="{{ old('Holiday_title') }}" required autocomplete="Holiday_title">

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
                        <input type="text" min="{{ $CarbonTimeAndDate->toDateString() }}"
                            value="{{ old('Holiday_start_date') ? old('Holiday_start_date') : $CarbonTimeAndDate->toDateString() }}"
                            id="Holiday_start_date" aria-label="Holiday_start_date" name="Holiday_start_date"
                            class="form-control  @error('Holiday_start_date') is-invalid @enderror" required>

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
                        <input type="text" value="{{ old('Holiday_start_time') ? old('Holiday_start_time') : "00:00" }}"
                            step="1800" id="Holiday_start_time" aria-label="Holiday_start_time"
                            name="Holiday_start_time" pattern="[0-9]{2}:[0-9]{2}"
                            class="form-control @error('Holiday_start_time') is-invalid @enderror" required>
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
                        <input type="text" min="{{ $CarbonTimeAndDate->toDateString() }}"
                            value="{{ old('Holiday_end_date') ? old('Holiday_end_date') : $NextDate->toDateString()  }}"
                            id="Holiday_end_date" aria-label="Holiday_end_date" name="Holiday_end_date"
                            class="form-control @error('Holiday_end_date') is-invalid @enderror" required>
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
                        <input type="text" value="{{ old('Holiday_end_time') ? old('Holiday_end_time') : "00:00" }}"
                            step="1800" id="Holiday_end_time" aria-label="Holiday_end_time" name="Holiday_end_time"
                            pattern="[0-9]{2}:[0-9]{2}" class="form-control @error('Holiday_end_time') is-invalid @enderror"
                            required>
                        @error('Holiday_end_time')
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

    <button type="submit" class="btn btn-primary btn-sm">Create</button>
    <a href="{{ route('admin.holidays.index') }}"><button type="button"
            class="btn btn-secondary btn-sm">Back</button></a>
    </form><hr>
</div>
<div class="col-sm-2 sidenav">
</div>

</div>
</div>
@endsection
