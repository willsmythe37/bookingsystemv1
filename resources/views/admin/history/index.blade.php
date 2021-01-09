@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
            <h1>All Bookings & History</h1>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <hr>
            <h3>Search Database</h3>
            <p>This will search the <strong>'name', 'surname', 'band', 'email'</strong> or <strong> 'phone number'</strong> rows of the <strong>'history'</strong> table
                with your word of choice.
                The database query that is implemented uses the 'LIKE' option. This means that you don't have to type
                the whole word in.</p>

            <form id="search" action="{{ route('admin.history.search')}}" method="GET">
                {{ method_field('GET')}}
                @csrf

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">{{ __('Search word') }}</label>

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

                <button type="submit" class="btn btn-primary btn-sm">Search History</button>
            </form>
            <hr>

            <h2>Search Between Selected Dates</h2>
            <p>Similar to the above, except this form can return searched results between a chosen time frame.</p>
                <p><em>Note: If you don't enter a 'search word', it will just return all the history within the chosen
                time-frame.</em></p>
            <br>
            <form id="range" action="{{ route('admin.history.range')}}" method="GET">
                {{ method_field('GET')}}
                @csrf

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">{{ __('Search word') }}</label>

                    <div class="col-md-6">
                        <input id="search" maxlength="50" type="text"
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
                            value="{{ old('Booking_end_date') ? old('Booking_end_date') : date("Y-m-d", strtotime('+1 days', strtotime( $now->toDateString() ))) }}"
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
                            step="1800" id="Booking_end_time" aria-label="Booking_end_time" pattern="[0-9]{2}:[0-9]{2}" name="Booking_end_time"
                            class="form-control @error('Booking_end_time') is-invalid @enderror" required>
                        @error('Booking_end_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Search user database</button>
            </form>
            <hr>

            @if($history->count() == 0)
                    <h3>There is currently no booking history to view</h3>
            @else

            <table class="table table-sm table-light table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User Details</th>
                        <th scope="col">Info</th>
                        <th scope="col">Costs</th>
                        <th scope="col">TimeStamps</th>
                        <th scope="col">Actions</th>
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
                            <strong>On: </strong>{{ date("d-m-Y", strtotime($h->Booking_start)) }}<br>
                            <strong>Day:</strong> {{ date("l", strtotime($h->Booking_start)) }}<br>
                            <strong>From: </strong>{{ date("H:i", strtotime($h->Booking_start)) }}<br>
                            <strong>To: </strong>{{ date("H:i", strtotime($h->Booking_end)) }}
                            @else
                            <strong>From: </strong>{{ date("d-m-Y H:i", strtotime($h->Booking_start)) }}<br>
                            <strong>To: </strong>{{ date("d-m-Y H:i", strtotime($h->Booking_end)) }}
                            @endif
                        </td>
                        <td><strong>Hours:</strong>
                            {{ $hours = ((strtotime($h->Booking_end) - strtotime($h->Booking_start)) / 3600) }}<br>
                            <strong>Room Cost: </strong>£{{ $h->priceperhour }}<br>
                            <strong>Equip Cost:</strong> £{{ $h->equiptotal }}<br>
                            <strong>Full Total:</strong> £{{ $h->Cost_of_booking }}</td>
                        <td style="
                                @if($h->status == "DELETED") background-color: #ffd9dc; //RED
                                @elseif($h->status == "ACCOUNT-DELETED") background-color: #f5ddba; //ORANGE
                                @elseif($h->status == "UPDATED") background-color: #d2ccfc; //More PURPLE
                            @else
                            background-color: #d9ddff; //PURPLE
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
                        <td>
                            <div class="btn-group-vertical btn-block">
                                <a class="btn btn-secondary btn-sm @if($h->status == "DELETED" || $h->status == "ACCOUNT-DELETED" || $now > date("Y-m-d H:i", strtotime('+7 days',strtotime($h->Booking_end))) ) disabled @endif"
                                href="{{ route('admin.history.usershow', $h->User_id) }}">Bookings</a>
                                <a class="btn btn-primary btn-sm @if($h->status == "DELETED" || $h->status == "ACCOUNT-DELETED" || $now > date("Y-m-d H:i", strtotime('+7 days',strtotime($h->Booking_end))) ) disabled @endif"
                                    href="{{ route('admin.bookings.edit', $h->Booking_id) }}">Edit</a>
                                <a class="btn btn-warning btn-sm @if($h->status == "DELETED" || $h->status == "ACCOUNT-DELETED" || $now > date("Y-m-d H:i", strtotime('+7 days',strtotime($h->Booking_end)))) disabled @endif"
                                    href="{{ route('admin.bookings.show', $h->Booking_id) }}">Delete</a></div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="pagination pagination-centered justify-content-center">
                {{ $history->links() }}</div>
            <br>
            @endif

            <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back to
                    Dashboard</button></a>
            <br>
            <hr>
            <div class="row">
                <div class="col-md-12">
            <h1>Further information</h1>
                </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <p>Sum of collected <strong>equipment fees:</strong> £{{ $equipsum }}<br>
                Sum of collected <strong>room fees:</strong> £{{ $roomsum }}<br>
                Sum of collected <strong>total fees: </strong>£{{ $totalsum }}<br>
                Sum of collected <strong>total hours:</strong> {{ $hoursum }}<br>
                <em style="color:red;">Note: the above only applies to those bookings which weren't deleted.</em></p>
            </div>
            <div class="col-md-6">
            <p>Total count of <strong>history entries found: </strong>{{ $historycount}}.<br>
                Total count of <strong>active history entries found:
                </strong>{{ $historycount - $historycountdeleted}}.<br>
                Number of history <strong>entries marked as 'deleted':</strong> {{ $historycountdeleted }}</p>
            </div>
        </div>
        @can('manage-system')
            <hr>

            <h1>Remove Data From System History</h1>
            <p>Using the link below we can clear up the contents of the History table.</p>
            <a href="{{ route('admin.history.clearup') }}"><button type="button" class="btn btn-warning">Clear up
                    history</button></a>
                    @endcan
            <hr>

        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
