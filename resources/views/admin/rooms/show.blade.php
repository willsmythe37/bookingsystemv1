@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
            <div>
                <h1>Deleting room - <em>{{ $room->roomname }}</em></h1>

                <div class="card-body">

                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST">
                        @csrf
                        {{ method_field('DELETE')}}

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Room name') }}</label>

                            <div class="col-md-6">
                                <input id="roomname" type="text" class="form-control @error('roomname') is-invalid @enderror"
                                    name="roomname" value="{{ $room->roomname }}" autocomplete="roomname" disabled>

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
                                <textarea spellcheck="true" rows="3" cols="50" id="shortdescription" type="text"
                                    class="form-control @error('shortdescription') is-invalid @enderror" name="shortdescription"
                                    autocomplete="shortdescription" disabled>{{ $room->shortdescription }}</textarea>

                                @error('shortdescription')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Long description') }}</label>

                            <div class="col-md-6">
                                <textarea spellcheck="true" rows="5" cols="50" id="longdescription" type="text" class="form-control @error('longdescription') is-invalid @enderror"
                                    name="longdescription" autocomplete="longdescription" disabled>{{ $room->longdescription }}</textarea>

                                @error('longdescription')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Price per hour') }}</label>

                            <div class="col-md-6">
                                <input id="priceperhour" type="number" step="0.1" class="form-control @error('priceperhour') is-invalid @enderror"
                                    name="priceperhour" value="{{ $room->priceperhour }}" autocomplete="priceperhour" disabled>

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
                                        Currently available to book?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                        <a href="{{ route('admin.rooms.index') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                    </form>
                </div>
            </div><hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
