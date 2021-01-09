<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $sitemetadata->title }}</title>
    <meta charset="{{ $sitemetadata->charset }}">
    <meta name="viewport" content="{{ $sitemetadata->viewport }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="{{ $sitemetadata->author }}">
    <meta http-equiv="refresh" content="{{ $sitemetadata->refresh }}">

    <!-- Misc METAs -->
    <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=UTF-8">
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="private">
            <META NAME="COPYRIGHT" CONTENT="&copy; 2020 {{ $sitemetadata->author }}">
                <META NAME="KEYWORDS" CONTENT="sex, drugs, rock & roll">
                    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">

    <!-- Scripts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if(Route::is('admin.metacontent.edit'))
    @else
        <style type="text/css">{{ $sitemetadata->customCSS }}</style>
    @endif


    {{-- <link rel="stylesheet" href="{{ asset('css/app-timepicker.min.css') }}"> --}}

</head>

<body>

    <div id="pre" style="font-size:largest;">

<nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container">
                @if($businessinfo->showimage1 == true)

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="max-height: 50px;" src="/Images/uploaded/{{ $businessinfo->image1 }}" alt="{{ $businessinfo->businessname }}" class="img-fluid rounded">
                </a>


                @else


                <a class="navbar-brand" href="{{ url('/') }}">
                    <nobr>{{ $businessinfo->businessname }} </nobr>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @endif

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.bookings.index', Auth::user())}}">
                                <nobr>My Bookings</nobr>
                            </a>
                        </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bookinginfo') }}">
                                <nobr>Booking info</nobr>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('room') }}">
                                <nobr>Rooms available</nobr>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('howtofindus') }}">
                                <nobr>How to find us</nobr>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('aboutus') }}">
                                <nobr>About us</nobr>
                            </a>
                        </li>
                    </ul>


                </div>
            </div>
        </nav>

        </div>

        <div id="body" style="display:none;">

    <div id="app">

        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container">
                @if($businessinfo->showimage1 == true)

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="max-height: 50px;" src="/Images/uploaded/{{ $businessinfo->image1 }}" alt="{{ $businessinfo->businessname }}" class="img-fluid rounded">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @else


                <a class="navbar-brand" href="{{ url('/') }}">
                    <nobr>{{ $businessinfo->businessname }} </nobr>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @endif

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.bookings.index', Auth::user())}}">
                                <nobr>My Bookings</nobr>
                            </a>
                        </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bookinginfo') }}">
                                <nobr>Booking info</nobr>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('room') }}">
                                <nobr>Rooms available</nobr>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('howtofindus') }}">
                                <nobr>How to find us</nobr>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('aboutus') }}">
                                <nobr>About us</nobr>
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} {{ Auth::user()->surname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('home') }}">
                                    {{ __('Dashboard') }}
                                </a>


                                <a class="dropdown-item divider disabled"></a>

                                <a class="dropdown-item" href="{{ route('user.edit', Auth::user())}}">
                                    Edit My Account Details
                                </a>



                                @can('manage-users')
                                <a class="dropdown-item" href="{{ route('admin.calendar.index')}}">
                                    View Admin Calendar
                                </a>
                                @endcan


                                @can('manage-users')
                                <a class="dropdown-item divider disabled"></a>

                                <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                    User Management
                                </a>

                                <a class="dropdown-item" href="{{ route('admin.history.index')}}">
                                    Booking & History Management
                                </a>

                                <a class="dropdown-item" href="{{ route('admin.bookings.index')}}">
                                    Bookings Management
                                </a>

                                <a class="dropdown-item" href="{{ route('admin.rooms.index') }}">
                                    Room Management
                                </a>

                                <a class="dropdown-item" href="{{ route('admin.holidays.index') }}">
                                    Holiday Management
                                </a>

                                <a class="dropdown-item" href="{{ route('admin.weblinks.index')}}">
                                    Weblinks Management
                                </a>

                                @endcan


                                <a class="dropdown-item divider disabled"></a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <br>



        <main class="py-1">
            @yield('content')
        </main>


            <div class="container-fluid"><footer class="footer">
                <div class="row">
                    <div class="col-sm-2 sidenav">
                    </div>
                    <div class="col-sm-8 text-left">

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="text-muted">
                                    <nobr><b>Copyright {{ $businessinfo->copyrightyear }}.</b></nobr>
                                </div>
                                <div>
                                    <nobr><a class="text-muted" href="{{ route('privacypolicy') }}">Privacy policy.</a>
                                    </nobr>
                                </div>
                                <div>
                                    <nobr><a class="text-muted" href="{{ route('termsandconditions') }}">Terms &
                                            conditions.</a></nobr>
                                </div>
                                <div>
                                    <nobr><a class="text-muted" href="{{ route('cookiepolicy') }}">Cookie policy.</a></nobr>
                                </div>
                                <br>
                            </div>
                            <div class="col-lg-3">
                                <div class="text-muted">
                                    <nobr><b>Contact info</b></nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr>P: <a class="text-muted"
                                            href="tel:{{ $businessinfo->phonenumber }}">{{ $businessinfo->phonenumber }}
                                        </a></nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr>E: <a class="text-muted"
                                            href="mailto:{{ $businessinfo->emailaddress }}">{{ $businessinfo->emailaddress }}
                                        </a></nobr>
                                </div>
                                <br>
                            </div>
                            <div class="col-lg-3">
                                <div class="text-muted">
                                    <nobr><b>Address: </b></nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr>{{ $businessinfo->businessname }} </nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr>{{ $businessinfo->housenumber }} {{ $businessinfo->streetname }}</nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr>{{ $businessinfo->town }} </nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr>{{ $businessinfo->county }} </nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr>{{ $businessinfo->postcode }} </nobr>
                                </div>
                                <br>
                            </div>
                            <div class="col-lg-3">
                                <div class="text-muted">
                                    <nobr><b>Business hours </b></nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr><strong>Mon: </strong>  {{ date("H:i", strtotime($businesshour->Mondaystart)) }} - {{ date("H:i", strtotime($businesshour->Mondayend)) }}</nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr><strong>Tue: </strong>  {{ date("H:i", strtotime($businesshour->Tuesdaystart)) }} - {{ date("H:i", strtotime($businesshour->Tuesdayend)) }}</nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr><strong>Wed:</strong>  {{ date("H:i", strtotime($businesshour->Wednesdaystart)) }} - {{ date("H:i", strtotime($businesshour->Wednesdayend)) }}</nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr><strong>Thu:</strong>  {{ date("H:i", strtotime($businesshour->Thursdaystart)) }} - {{ date("H:i", strtotime($businesshour->Thursdayend)) }}</nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr><strong>Fri:</strong>  {{ date("H:i", strtotime($businesshour->Fridaystart)) }} - {{ date("H:i", strtotime($businesshour->Fridayend)) }}</nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr><strong>Sat:</strong>  {{ date("H:i", strtotime($businesshour->Saturdaystart)) }} - {{ date("H:i", strtotime($businesshour->Saturdayend)) }}</nobr>
                                </div>
                                <div class="text-muted">
                                    <nobr><strong>Sun:</strong>  {{ date("H:i", strtotime($businesshour->Sundaystart)) }} - {{ date("H:i", strtotime($businesshour->Sundayend)) }}</nobr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 sidenav">
                    </div>
                </div>
            </div>
    </footer></div>
    <br>


    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @if(Route::is('user.bookings.edit') || Route::is('booking') || Route::is('admin.bookings.edit') || Route::is('admin.holidays.create') || Route::is('admin.holidays.edit') || Route::is('admin.history.index')|| Route::is('admin.history.clearup'))
    <script src="{{ asset('js/app-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/app-jquery-ui.min.js') }}"></script>
    @endif
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#body').show();
    $('#pre').hide();
});
</script>
</body>
</html>
