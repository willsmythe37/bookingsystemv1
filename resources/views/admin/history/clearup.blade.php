@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
            <h1>Clearup History</h1>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <h3 style="color:red">!!! PROCEED WITH CAUTION !!!</h3>
            <br>
            <p>This area allows us to select a time span, and remove the history associated with it from the system.
                This is implemented in order for us to clear out old history which is no longer required.</p>
            <p>Select a word and/or the date ranges you may wish to remove. The server will collect all history records and
                display them on the next page.</p>
                <p>Removing the history here, <strong>does not </strong>remove the BOOKINGS from the system!!! This function only affects the history table.<br>
                    Further to this, removing the history will remove your 'edit' and 'delete' buttons preventing you from adjusting existing bookings.</p>

            <form id="range" action="{{ route('admin.history.clearupshow')}}" method="GET">
                {{ method_field('GET')}}
                @csrf

                <div class="form-group row">
                    <label for="Search word"
                        class="col-md-3 col-form-label text-md-right">{{ __('Search word') }}</label>

                    <div class="col-md-6">
                        <input id="search" maxlength="50" type="text"  placeholder="e.g. fred"
                            class="form-control @error('search') is-invalid @enderror" name="search"
                            value="{{ old('search') }}" autocomplete="search">

                        @error('search')
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
                        <input type="text"
                            value="{{ old('Booking_start_date') ? old('Booking_start_date') : $now->toDateString()}}"
                            id="Booking_start_date" aria-label="Booking_start_date" name="Booking_start_date"
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
                        <input type="text" value="{{ old('Booking_start_time') ? old('Booking_start_time') : "00:00" }}"
                            step="1800" id="Booking_start_time" aria-label="Booking_start_time"
                            name="Booking_start_time" pattern="[0-9]{2}:[0-9]{2}"
                            class="form-control @error('Booking_start_time') is-invalid @enderror" required>
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
                        <input type="text" min="{{ $now->toDateString() }}"
                            value="{{ old('Booking_end_date') ? old('Booking_end_date') : date("Y-m-d", strtotime('+1 days', strtotime( $now->toDateString() )))}}"
                            id="Booking_end_date" aria-label="Booking_end_date" name="Booking_end_date"
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
                        <input type="text" value="{{ old('Booking_end_time') ? old('Booking_end_time') : "00:00" }}"
                            step="1800" id="Booking_end_time" aria-label="Booking_end_time" name="Booking_end_time" pattern="[0-9]{2}:[0-9]{2}"
                            class="form-control @error('Booking_end_time') is-invalid @enderror" required>
                        @error('Booking_end_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <button type="submit" class="btn btn-warning btn-sm">Clear up history database only</button><a
                    href="{{ route('admin.history.index') }}"><button type="button"
                        class="btn btn-secondary btn-sm">Back to History</button></a>
            </form>


            <hr><br>
            <h1>Clearup History & Bookings</h1>
            <h3 style="color:red">!!! PROCEED WITH CAUTION !!!</h3>
<br>
            <p>This form is similar to the above except it is used to remove the history AND the bookings associated with the form criteria.
                This is implemented in order for us to clear out old history and bookings for users and administrators.</p>
                <p>Perhaps two years down the line, you notice a slow-down in system performance,
                    you can use this function to remove the earliest bookings from the system.</p>
                    <p>You should be aware that what is shown on the following page is <strong>not an accurate representation </strong>of what will be removed. The dates and times are are used to perform two identical database queries and then deleting collected items separately.<br> Therefore, if an administrator has cleared out history prior to this, you won't be able to see the associated bookings that are also being removed in the adjacent 'Bookings' table.
                    <p style="color:red"><em>Note: This removes items from both the History AND Bookings tables, therefore, users won't be able to see previous bookings on their accounts any longer and neither will you!</em></p>

            <form id="range" action="{{ route('admin.history.nuclear')}}" method="GET">
                {{ method_field('GET')}}
                @csrf

                <div class="row">
                    <div class="input-group col-lg-6">
                        <label class="input-group-prepend">
                            <span class="input-group-text">Start date</span>
                        </label>
                        <input type="text"
                            value="{{ old('Booking_start_date') ? old('Booking_start_date') : $now->toDateString()}}"
                            id="Booking_start_date2" aria-label="Booking_start_date" name="Booking_start_date"
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
                        <input type="text" value="{{ old('Booking_start_time') ? old('Booking_start_time') : "00:00" }}"
                            step="1800" id="Booking_start_time" aria-label="Booking_start_time"
                            name="Booking_start_time" pattern="[0-9]{2}:[0-9]{2}"
                            class="Booking_start_time form-control @error('Booking_start_time') is-invalid @enderror" required>
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
                        <input type="text" min="{{ $now->toDateString() }}"
                            value="{{ old('Booking_end_date') ? old('Booking_end_date') : date("Y-m-d", strtotime('+1 days', strtotime( $now->toDateString() )))}}"
                            id="Booking_end_date2" aria-label="Booking_end_date" name="Booking_end_date"
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
                        <input type="text" value="{{ old('Booking_end_time') ? old('Booking_end_time') : "00:00" }}"
                            step="1800" id="Booking_end_time" aria-label="Booking_end_time" name="Booking_end_time" pattern="[0-9]{2}:[0-9]{2}"
                            class="Booking_end_time form-control @error('Booking_end_time') is-invalid @enderror" required>
                        @error('Booking_end_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <button type="submit" class="btn btn-warning btn-sm">Clear up history AND bookings database</button><a
                    href="{{ route('admin.history.index') }}"><button type="button"
                        class="btn btn-secondary btn-sm">Back to History</button></a>
            </form>


            <hr>

        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
