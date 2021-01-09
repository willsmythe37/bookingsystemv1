@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-sm-8">

            @if($sitecontent->show1 == true)
            <div class="row">

                @if($sitecontent->showimage1 == false)
                <div class="col-md-12">
                    <h1>{{ $sitecontent->title1 }}</h1>
                    <p style="white-space: pre-wrap;">{{ $sitecontent->body1 }}</p>
                </div>
            </div>
            <hr>
            @else

            <div class="col-lg-8">
                <h1>{{ $sitecontent->title1 }}</h1>
                <p style="white-space: pre-wrap;">{{ $sitecontent->body1 }}</p>
            </div>

            <div class="col-lg-4">
                <img src="/Images/uploaded/{{$sitecontent->image1}}" style="padding: 20px 20px 20px 20px;"
                    alt="{{$sitecontent->image1}}" class="img-fluid rounded">
            </div>

        </div>
        <hr>
        @endif
        @endif


        @if($sitecontent->show2 == true)
        <div class="row">
            @if($sitecontent->showimage2 == false)
            <div class="col-md-12">

                <h1>{{ $sitecontent->title2 }}</h1>
                <p style="white-space: pre-wrap;">{{ $sitecontent->body2 }}</p>
            </div>
        </div>
        <hr>
        @else

        <div class="col-md-4">
            <img src="/Images/uploaded/{{$sitecontent->image2}}" style="padding: 20px 20px 20px 20px;"
                alt="{{$sitecontent->image2}}" class="img-fluid rounded">
        </div>

        <div class="col-md-8 order-first order-md-last">
            <h1>{{ $sitecontent->title2 }}</h1>
            <p style="white-space: pre-wrap;">{{ $sitecontent->body2 }}</p>
        </div>

    </div>
    <hr>
    @endif
    @endif


    @if($sitecontent->show3 == true)
    <div class="row">
        @if($sitecontent->showimage3 == false)
        <div class="col-md-12">
            <h1>{{ $sitecontent->title3 }}</h1>
            <p style="white-space: pre-wrap;">{{ $sitecontent->body3 }}</p>
        </div>
    </div><hr>
    @else

    <div class="col-md-8">
        <h1>{{ $sitecontent->title3 }}</h1>
        <p style="white-space: pre-wrap;">{{ $sitecontent->body3 }}</p>
    </div>

    <div class="col-md-4">
        <img src="/Images/uploaded/{{$sitecontent->image3}}" style="padding: 20px 20px 20px 20px;"
            alt="{{$sitecontent->image3}}" class="img-fluid rounded">
    </div>

</div><hr>
@endif
@endif

@if($bookingcomplete->Equip->guitarheadamount == 0 && $bookingcomplete->Equip->guitarcabamount == 0 && $bookingcomplete->Equip->guitarcomboamount == 0 && $bookingcomplete->Equip->bassheadamount == 0 && $bookingcomplete->Equip->basscabamount == 0 && $bookingcomplete->Equip->basscomboamount == 0 && $bookingcomplete->Equip->drumkitamount == 0 && $bookingcomplete->Equip->cymbalsamount == 0 )

<div class="row text-center">

    <div class="col-md-6">
        <h3>Booking Info</h3>

        <p><strong>ID </strong>: {{ $bookingcomplete->id }}<br>
            <strong>Name </strong>: {{  $bookingcomplete->User->name }} {{  $bookingcomplete->User->surname }}<br>
            <strong>Associated band </strong>: {{  $bookingcomplete->User->band }}<br>
            <strong>Room name </strong>: {{  $bookingcomplete->Room->roomname }}<br>
            <strong>Day </strong>: {{ date("l", strtotime($bookingcomplete->Booking_start)) }}<br>
            @if(date("d-m-Y", strtotime($bookingcomplete->Booking_start)) == date("d-m-Y", strtotime($bookingcomplete->Booking_end)))
            <strong>Date </strong>: {{ date("d-m-Y", strtotime($bookingcomplete->Booking_start)) }}<br>
            @else
            <strong>Start date </strong>: {{ date("d-m-Y", strtotime($bookingcomplete->Booking_start)) }}<br>
            <strong>End date </strong>: {{ date("d-m-Y", strtotime($bookingcomplete->Booking_end )) }}<br>
            @endif
            <strong>Time </strong>: {{ date("H:i", strtotime($bookingcomplete->Booking_start )) }} - {{ date("H:i", strtotime($bookingcomplete->Booking_end )) }}<br>


    </div>

    <div class="col-md-6">

        <h3>Booking Cost</h3>
        <p>
        <strong>Total hours </strong>: {{ $Hours }}<br>
        <strong>Room cost </strong>: £{{ $bookingcomplete->Room->priceperhour }}<br>
        <strong>Room subtotal </strong>:
        £{{  number_format(($bookingcomplete->Cost_of_booking - $bookingcomplete->Equip->equiptotal), 2) }} <br>
        <strong>Equipment subtotal </strong>: £{{  number_format($bookingcomplete->Equip->equiptotal, 2) }} <br>
        <strong style="font-size:150%">Total : £{{  number_format($bookingcomplete->Cost_of_booking, 2) }} </strong></p> <br><br>

    </div>
    <div class="col-md-12">

        <a href="{{ route('user.bookings.index', Auth::user())}}"><button type="button" class="btn btn-secondary btn-sm align-left"><nobr>My Bookings</nobr></button></a>
        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm align-left">Dashboard</button></a>

    </div>
</div>

@else
<div class="row text-center">

    <div class="col-md-6">
        <h3>Booking Info</h3>

        <p><strong>ID </strong>: {{ $bookingcomplete->id }}<br>
            <strong>Name </strong>: {{  $bookingcomplete->User->name }} {{  $bookingcomplete->User->surname }}<br>
            <strong>Associated band </strong>: {{  $bookingcomplete->User->band }}<br>
            <strong>Room name </strong>: {{  $bookingcomplete->Room->roomname }}<br>
            <strong>Day </strong>: {{ date("l", strtotime($bookingcomplete->Booking_start)) }}<br>
            @if(date("d-m-Y", strtotime($bookingcomplete->Booking_start)) == date("d-m-Y", strtotime($bookingcomplete->Booking_end)))
            <strong>Date </strong>: {{ date("d-m-Y", strtotime($bookingcomplete->Booking_start)) }}<br>
            @else
            <strong>Start date </strong>: {{ date("d-m-Y", strtotime($bookingcomplete->Booking_start)) }}<br>
            <strong>End date </strong>: {{ date("d-m-Y", strtotime($bookingcomplete->Booking_end )) }}<br>
            @endif
            <strong>Time </strong>: {{ date("H:i", strtotime($bookingcomplete->Booking_start )) }} - {{ date("H:i", strtotime($bookingcomplete->Booking_end )) }}<br>
            <strong>Total hours </strong>: {{ $Hours }}<br>
            <strong>Room cost </strong>: £{{ $bookingcomplete->Room->priceperhour }}<br>


    </div>

    <div class="col-md-6">
        <h3>Equipment Info</h3>

        <p>
            @if( $bookingcomplete->Equip->guitarheadamount != 0)
            <strong>Guitar Head </strong>: {{  $bookingcomplete->Equip->guitarheadamount }} <small>(£{{  $currenthireprices->guitarhead }} each)</small><br>
            @endif
            @if( $bookingcomplete->Equip->guitarcabamount != 0)
            <strong>Guitar Cabs </strong>: {{  $bookingcomplete->Equip->guitarcabamount }} <small>(£{{  $currenthireprices->guitarcab }} each</small><br>
            @endif
            @if( $bookingcomplete->Equip->guitarcomboamount != 0)
            <strong>Guitar Combos </strong>: {{  $bookingcomplete->Equip->guitarcomboamount }} <small>(£{{  $currenthireprices->guitarcombo }} each</small>)<br>
            @endif

            @if( $bookingcomplete->Equip->bassheadamount != 0)
            <strong>Bass Head </strong>: {{  $bookingcomplete->Equip->bassheadamount }} <small>(£{{  $currenthireprices->basshead }} each)</small><br>
            @endif
            @if( $bookingcomplete->Equip->basscabamount != 0)
            <strong>Bass Cabs </strong>: {{  $bookingcomplete->Equip->basscabamount }} <small>(£{{  $currenthireprices->basscab }} each)</small><br>
            @endif
            @if( $bookingcomplete->Equip->basscomboamount != 0)
            <strong>Bass Combos </strong>: {{  $bookingcomplete->Equip->basscomboamount }} <small>(£{{  $currenthireprices->basscombo }} each)</small><br>
            @endif

            @if( $bookingcomplete->Equip->drumkitamount != 0)
            <strong>Drum Kits </strong>: {{  $bookingcomplete->Equip->drumkitamount }} <small>(£{{  $currenthireprices->drumkit }} per set)</small><br>
            @endif

            @if( $bookingcomplete->Equip->cymbalsamount != 0)
            <strong>Sets of Cymbals </strong>: {{  $bookingcomplete->Equip->cymbalsamount }} <small>(£{{  $currenthireprices->cymbals }} per set)</small><br>
            @endif
        </p>

    </div>
    <div class="col-md-12">

        <h3>Booking Cost</h3>
        <strong>Room subtotal </strong>:
        £{{  number_format(($bookingcomplete->Cost_of_booking - $bookingcomplete->Equip->equiptotal), 2) }} <br>
        <strong>Equipment subtotal </strong>: £{{  number_format($bookingcomplete->Equip->equiptotal, 2) }} <br>
        <strong style="font-size:150%">Total : £{{  number_format($bookingcomplete->Cost_of_booking, 2) }} </strong> <br><br>

        <a href="{{ route('user.bookings.index', Auth::user())}}"><button type="button" class="btn btn-secondary btn-sm align-left"><nobr>My Bookings</nobr></button></a>
        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm align-left">Dashboard</button></a>

    </div>
</div>
@endif
<hr>
</div>
<div class="col-sm-2 sidenav">
</div>

</div>
<div>

    @endsection
