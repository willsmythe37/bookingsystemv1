@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">

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
                <img src="/Images/uploaded/{{$sitecontent->image1}}" style="padding: 20px 20px 20px 20px;" alt="{{$sitecontent->image1}}"
                    class="img-fluid rounded">
            </div>


        </div><hr>
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
                            <img src="/Images/uploaded/{{$sitecontent->image2}}" style="padding: 20px 20px 20px 20px;" alt="{{$sitecontent->image2}}"
                                class="img-fluid rounded">
                        </div>

            <div class="col-md-8 order-first order-md-last">

                <h1>{{ $sitecontent->title2 }}</h1>
                <p style="white-space: pre-wrap;">{{ $sitecontent->body2 }}</p>

            </div>




        </div><hr>
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
                <img src="/Images/uploaded/{{$sitecontent->image3}}" style="padding: 20px 20px 20px 20px;" alt="{{$sitecontent->image3}}"
                    class="img-fluid rounded">
            </div>


        </div><hr>
        @endif

        @endif


            <div class="card">
                <div class="card-header">Dashboard</div>



                <a class="dropdown-item divider disabled"></a>

                <a class="dropdown-item text-center" href="{{ route('user.bookings.index', Auth::user())}}">
                    My Bookings
                </a>

                <a class="dropdown-item text-center" href="{{ route('user.edit', Auth::user())}}">
                    Edit My Account Details
                </a>



                @can('manage-users')
                <a class="dropdown-item text-center" href="{{ route('admin.calendar.index')}}">
                    View Admin Calendar
                </a>
                @endcan


                @can('manage-users')
                <a class="dropdown-item divider disabled"></a>

                <a class="dropdown-item text-center" href="{{ route('admin.users.index') }}">
                    User Management
                </a>

                <a class="dropdown-item text-center" href="{{ route('admin.history.index')}}">
                    Bookings & History Management
                </a>

                <a class="dropdown-item text-center" href="{{ route('admin.bookings.index')}}">
                    Bookings Management
                </a>

                <a class="dropdown-item text-center" href="{{ route('admin.rooms.index') }}">
                    Room Management
                </a>

                <a class="dropdown-item text-center" href="{{ route('admin.holidays.index') }}">
                    Holiday Management
                </a>

                <a class="dropdown-item text-center" href="{{ route('admin.weblinks.index')}}">
                    Weblinks Management
                </a>

                <a class="dropdown-item text-center" href="{{ route('admin.mailinglist')}}">
                    Mailing List Groups
                </a>

                @endcan

                @can('manage-users')
                <a class="dropdown-item divider disabled"></a>


                <a class="dropdown-item text-center" href="{{ route('admin.hireprice.edit', $hireprices)}}">
                    Update Hire Prices
                </a>


                <a class="dropdown-item text-center" href="{{ route('admin.sitecontent.index') }}">
                    Update Site Contents
                </a>

                <a class="dropdown-item text-center" href="{{ route('admin.metacontent.edit', $sitemetadata)}}">
                    Update Site Metadata
                </a>

                <a class="dropdown-item text-center" href="{{ route('admin.businessinfo.edit', $businessinfo) }}">
                    Update Business Info
                </a>

                <a class="dropdown-item text-center" href="{{ route('admin.businesshour.edit', 1) }}">
                    Update Business Hours
                </a>
                @endcan

                <a class="dropdown-item divider disabled"></a>
                <a class="dropdown-item text-center" href="{{ route('user.show', Auth::user())}}">
                    Delete My Account
                </a>
                <a class="dropdown-item divider disabled"></a>

                <a class="dropdown-item text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <br>
            </div><hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
