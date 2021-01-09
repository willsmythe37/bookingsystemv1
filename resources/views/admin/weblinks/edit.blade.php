@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
                <h1>Edit weblink - <em>{{  $weblink->name }}</em></h1>


                    <form action="{{ route('admin.weblinks.update',  $weblink) }}" method="POST">
                        @csrf
                        {{ method_field('PUT')}}

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Weblink name') }}</label>

                            <div class="col-md-6">
                                <input id="name" maxlength="255" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{  $weblink->name }}" required autocomplete="name">

                                @error('name')
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
                                <textarea spellcheck="true" rows="3" cols="50" id="shortdescription" maxlength="500" type="text"
                                    class="form-control @error('shortdescription') is-invalid @enderror" name="shortdescription"
                                    required autocomplete="shortdescription">{{  $weblink->shortdescription }}</textarea>

                                @error('shortdescription')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Web URL/link') }}</label>

                            <div class="col-md-6">
                                <textarea rows="5" cols="50" id="webURL" maxlength="1000" type="text" class="form-control @error('webURL') is-invalid @enderror"
                                    name="webURL" required autocomplete="webURL">{{  $weblink->webURL }}</textarea>

                                @error('webURL')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Sort order') }}</label>

                <div class="col-md-6">
                    <input id="order" type="number" step="1" min="0" class="form-control @error('order') is-invalid @enderror"
                        name="order" value="{{ old('order') ? old('order') : "0" }}" required autocomplete="order">

                    @error('order')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        <a href="{{ route('admin.weblinks.index') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                    </form><hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
