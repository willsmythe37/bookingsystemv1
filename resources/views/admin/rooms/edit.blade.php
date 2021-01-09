@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
                <h1>Editing Room - <em>{{  $room->roomname }}</em></h1>


                    <form action="{{ route('admin.rooms.update',  $room) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        {{ method_field('PUT')}}

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Room name') }}</label>

                            <div class="col-md-6">
                                <input id="roomname" maxlength="50" type="text"
                                    class="form-control @error('roomname') is-invalid @enderror" name="roomname"
                                    value="{{  $room->roomname }}" required autocomplete="roomname">

                                @error('roomname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="col-md-4 col-form-label text-md-right">{{ __('Short description') }}</label>

                            <div class="col-md-6">
                                <textarea spellcheck="true" rows="3" cols="50" id="shortdescription" maxlength="255" type="text"
                                    class="form-control @error('shortdescription') is-invalid @enderror" name="shortdescription"
                                    required autocomplete="shortdescription">{{  $room->shortdescription }}</textarea>

                                @error('shortdescription')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Long description') }}</label>

                            <div class="col-md-6">
                                <textarea spellcheck="true" rows="5" cols="50" id="longdescription" maxlength="1000" type="text" class="form-control @error('longdescription') is-invalid @enderror"
                                    name="longdescription" required autocomplete="longdescription">{{  $room->longdescription }}</textarea>

                                @error('longdescription')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Price per hour') }}</label>

                            <div class="col-md-6">
                                <input id="priceperhour" type="number" step="0.1" class="form-control @error('priceperhour') is-invalid @enderror"
                                    name="priceperhour" value="{{  $room->priceperhour }}" required autocomplete="priceperhour">

                                @error('priceperhour')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input name="available" type="hidden" value="0">
                                    <input class="form-check-input" type="checkbox" name="available" value="1"
                                    autocomplete="available"
                                    @if(old('available', $room->available))
                                    checked
                                    @endif
                                    >

                                    <label class="form-check-label">
                                        Make the space bookable?
                                    </label>
                                </div>
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
                                    @if(old('showimage1', $room->showimage1))
                                    checked
                                    @endif
                                    >


                                    <label class="form-check-label">
                                        Select to show 'Image 1'. (This is displayed to the <strong>right</strong> of the section)
                                    </label>
                                    <div class="col-sm-4">
                                        <img src="/Images/uploaded/{{$room->image1}}" alt="Image" class="img-fluid">
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        <a href="{{ route('admin.rooms.index') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                    </form><hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
