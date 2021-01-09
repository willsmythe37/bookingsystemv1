


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





      </div>

      <div class="col-sm-2 sidenav">
      </div>

    </div>
    <div>


@endsection
