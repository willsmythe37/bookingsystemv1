<!DOCTYPE html>
<html>

<head>
    <title>-- Booking Deleted --</title>
    <style>
        .container {
            position: relative;
            width: 100%;
        }

        .body {
            color: grey;
            margin: 0;
            font-family: "Nunito", sans-serif;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f8fafc;
        }

        .button {
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            background-color: #008CBA;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 style="text-align: center;">More Information</h2>
        <p>
            <strong>Name: </strong> {{ $booking->User->name }} {{ $booking->User->surname }}<br>
            <Strong>Band: </strong> {{ $booking->User->band }} <br>
            <strong>Room: </strong><nobr>{{ $booking->Room->roomname }}</nobr><br>

            @if(date("d-m-Y", strtotime($booking->Booking_start)) == date("d-m-Y", strtotime($booking->Booking_end)))
            <strong>Day:</strong> {{ date("l", strtotime($booking->Booking_start)) }}<br>
            <strong>Date:</strong> {{ date("d-m-Y", strtotime($booking->Booking_start)) }}<br>
            <strong>Time:</strong> {{ date("H:i", strtotime($booking->Booking_start)) }} : {{ date("H:i", strtotime($booking->Booking_end)) }}<br>
            @else
            <strong>Day: </strong> {{ date("l", strtotime($booking->Booking_start)) }}<br>
            <strong>Date Start:</strong> {{ date("d-m-Y", strtotime($booking->Booking_start)) }}<br>
            <strong>Date End:</strong> {{ date("d-m-Y", strtotime($booking->Booking_end)) }}<br>
            <strong>Time:</strong> {{ date("H:i", strtotime($booking->Booking_start)) }}-{{ date("H:i", strtotime($booking->Booking_end)) }}<br>
            @endif
            <strong>Hours: </strong>
            {{ $hours = (strtotime($booking->Booking_end) - strtotime($booking->Booking_start)) / 3600 }}<br>
        </p>
        <div style="text-align: center;">
            <a class="button" href="{{ route('home') }}">Take me to the Dashboard</a><br>
        </div>
    </div>
</body>

</html>
