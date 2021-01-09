@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-centre">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">
            <h1 class="text-center">Admin Calendar</h1>

            <div id="app">
                <admin-calendar-component></admin-calendar-component>
            </div>
            <br>

            <div class="btn-group btn-block">
                @foreach($allrooms as $a)
                @if($a == $selectedroom)
                @else
                <a type="button" class="btn btn-info" href="{{ route('booking', $a) }}">{{ $a->roomname }}</a>
                @endif
                @endforeach
                @can('manage-users')
                <a type="button" class="btn btn-info" href="{{ route('admin.calendar.index')}}">All</a>
                @endcan
            </div><hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>
        <hr>
    </div>
</div>
@endsection
