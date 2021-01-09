@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
            <h1>User's Bookings & History</h1>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <br>

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
                            <strong>Day:</strong> {{ date("l", strtotime($h->Booking_start)) }}<br>
                            <strong>On: </strong>{{ date("d-m-Y", strtotime($h->Booking_start)) }}<br>
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
                            <div class="btn-group-vertical btn-block"><a class="btn btn-primary btn-sm @if($h->status == "DELETED" || $h->status == "ACCOUNT-DELETED" || $now > date("Y-m-d H:i", strtotime('+7 days',strtotime($h->Booking_end))) ) disabled @endif"
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
            <a href="{{ route('admin.history.index') }}"><button type="button" class="btn btn-secondary btn-sm">History</button></a>
            <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Dashboard</button></a>
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
        @can('manage:system')
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
