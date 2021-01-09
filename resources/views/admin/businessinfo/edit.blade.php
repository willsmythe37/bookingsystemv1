@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">
            <div>
                <h1>Edit Business Info</h1>

                <div class="card-body">

                    <form action="{{ route('admin.businessinfo.update',  $businessinfo) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        {{ method_field('PUT')}}

                        <div class="form-group row">
                            <label
                                class="col-md-4 col-form-label text-md-right">{{ __('Copyright year') }}</label>

                            <div class="col-md-6">
                                <input id="copyrightyear" type="number" min="2000" max="2050"
                                    class="form-control @error('copyrightyear') is-invalid @enderror" name="copyrightyear"
                                    value="{{  $businessinfo->copyrightyear }}" required autocomplete="copyrightyear">

                                @error('copyrightyear')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}</label>

                            <div class="col-md-6">
                                <input id="phonenumber" maxlength="30" type="text"
                                    class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber"
                                    value="{{  $businessinfo->phonenumber }}" required autocomplete="phonenumber">

                                @error('phonenumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Email address') }}</label>

                            <div class="col-md-6">
                                <input id="emailaddress" maxlength="30" type="text" class="form-control @error('emailaddress') is-invalid @enderror"
                                    name="emailaddress" value="{{  $businessinfo->emailaddress }}" required autocomplete="emailaddress">

                                @error('emailaddress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Business name') }}</label>

                            <div class="col-md-6">
                                <input id="businessname" maxlength="30" type="text" class="form-control @error('businessname') is-invalid @enderror"
                                    name="businessname" value="{{  $businessinfo->businessname }}" required autocomplete="businessname">

                                @error('businessname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('House number') }}</label>

                            <div class="col-md-6">
                                <input id="housenumber" maxlength="30" type="text" class="form-control @error('housenumber') is-invalid @enderror"
                                    name="housenumber" value="{{  $businessinfo->housenumber }}" autocomplete="housenumber">

                                @error('housenumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Street name') }}</label>

                            <div class="col-md-6">
                                <input id="streetname" maxlength="30" type="text" class="form-control @error('streetname') is-invalid @enderror"
                                    name="streetname" value="{{  $businessinfo->streetname }}" autocomplete="streetname">

                                @error('streetname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Town') }}</label>

                            <div class="col-md-6">
                                <input id="town" maxlength="30" type="text" class="form-control @error('town') is-invalid @enderror"
                                    name="town" value="{{  $businessinfo->town }}" autocomplete="town">

                                @error('town')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('County') }}</label>

                            <div class="col-md-6">
                                <input id="county" maxlength="30" type="text" class="form-control @error('county') is-invalid @enderror"
                                    name="county" value="{{  $businessinfo->county }}" autocomplete="county">

                                @error('county')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                <input id="postcode" maxlength="30" type="text" class="form-control @error('postcode') is-invalid @enderror"
                                    name="postcode" value="{{  $businessinfo->postcode }}" autocomplete="postcode">

                                @error('postcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-3">
                                <label class="control-label"><strong>Select 'Image1'  </strong></label><br>
                                    <input type="file" name="image1" /><br>
                                    <small class="error">{{$errors->first('image1')}}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input name="showimage1" type="hidden" value="0">
                                    <input class="form-check-input" type="checkbox" name="showimage1" value="1"
                                    autocomplete="showimage1"
                                    @if(old('showimage1', $businessinfo->showimage1))
                                    checked
                                    @endif
                                    >


                                    <label class="form-check-label" >
                                        Select to show 'Image 1'. (This is displayed to the <strong>left</strong> of the Navbar)
                                    </label>
                                    <div class="col-sm-4">
                                        <img src="/Images/uploaded/{{$businessinfo->image1}}" alt="Image" class="img-fluid">
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right">{{ __('Email notifications') }}</label>

                            <div class="col-md-6">

                                <input id="emailnotifications" maxlength="50" type="text" class="form-control @error('emailnotifications') is-invalid @enderror"
                                    name="emailnotifications" value="{{  $businessinfo->emailnotifications }}" autocomplete="emailnotifications">

                                @error('emailnotifications')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <p><small>This is will be the recipient of <strong>'email notifications'</strong> generated when bookings have been <strong>created</strong>, <strong>updated</strong> or <strong>deleted.</strong></small></p>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                    </form>

            </div><hr>
    </div>
</div>
<div class="col-sm-2 sidenav">
</div>
</div>
</div>
@endsection
