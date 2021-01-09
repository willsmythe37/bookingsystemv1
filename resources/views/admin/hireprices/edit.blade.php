@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">
                <h1>Edit Hire Prices</h1>


                    <form action="{{ route('admin.hireprice.update',  $hireprice) }}" method="POST">
                        @csrf
                        {{ method_field('PUT')}}

                        <div class="form-group row">
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label ">{{ __('Guitar head cost') }}</label>
                            </div>

                            <div class="col-md-3">
                                <input id="guitarhead" type="number" step="0.1" class="form-control @error('guitarhead') is-invalid @enderror"
                                    name="guitarhead" value="{{  $hireprice->guitarhead }}" required autocomplete="guitarhead">

                                @error('guitarhead')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label">{{ __('Stock') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="guitarheadstock" type="number" step="1" class="form-control @error('guitarheadstock') is-invalid @enderror"
                                    name="guitarheadstock" value="{{  $hireprice->guitarheadstock }}" required autocomplete="guitarheadstock">

                                @error('guitarheadstock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Guitar cab cost') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="guitarcab" type="number" step="0.1" class="form-control @error('guitarcab') is-invalid @enderror"
                                    name="guitarcab" value="{{  $hireprice->guitarcab }}" required autocomplete="guitarcab">

                                @error('guitarcab')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Stock') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="guitarcabstock" type="number" step="1" class="form-control @error('guitarcabstock') is-invalid @enderror"
                                    name="guitarcabstock" value="{{  $hireprice->guitarcabstock }}" required autocomplete="guitarcabstock">

                                @error('guitarcabstock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Guitar combo cost') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="guitarcombo" type="number" step="0.1" class="form-control @error('guitarcombo') is-invalid @enderror"
                                    name="guitarcombo" value="{{  $hireprice->guitarcombo }}" required autocomplete="guitarcombo">

                                @error('guitarcombo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Stock') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="guitarcombostock" type="number" step="1" class="form-control @error('guitarcombostock') is-invalid @enderror"
                                    name="guitarcombostock" value="{{  $hireprice->guitarcombostock }}" required autocomplete="guitarcombostock">

                                @error('guitarcombostock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Bass head cost') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="basshead" type="number" step="0.1" class="form-control @error('basshead') is-invalid @enderror"
                                    name="basshead" value="{{  $hireprice->basshead }}" required autocomplete="basshead">

                                @error('basshead')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Stock') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="bassheadstock" type="number" step="1" class="form-control @error('bassheadstock') is-invalid @enderror"
                                    name="bassheadstock" value="{{  $hireprice->bassheadstock }}" required autocomplete="bassheadstock">

                                @error('bassheadstock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Bass cab cost') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="basscab" type="number" step="0.1" class="form-control @error('basscab') is-invalid @enderror"
                                    name="basscab" value="{{  $hireprice->basscab }}" required autocomplete="basscab">

                                @error('basscab')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Stock') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="basscabstock" type="number" step="1" class="form-control @error('basscabstock') is-invalid @enderror"
                                    name="basscabstock" value="{{  $hireprice->basscabstock }}" required autocomplete="basscabstock">

                                @error('basscabstock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Bass combo cost') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="basscombo" type="number" step="0.1" class="form-control @error('basscombo') is-invalid @enderror"
                                    name="basscombo" value="{{  $hireprice->basscombo }}" required autocomplete="basscombo">

                                @error('basscombo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Stock') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="basscombostock" type="number" step="1" class="form-control @error('basscombostock') is-invalid @enderror"
                                    name="basscombostock" value="{{  $hireprice->basscombostock }}" required autocomplete="basscombostock">

                                @error('basscombostock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Drum-kits cost') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="drumkit" type="number" step="0.1" class="form-control @error('drumkit') is-invalid @enderror"
                                    name="drumkit" value="{{  $hireprice->drumkit }}" required autocomplete="drumkit">

                                @error('drumkit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Stock') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="drumkitstock" type="number" step="1" class="form-control @error('drumkitstock') is-invalid @enderror"
                                    name="drumkitstock" value="{{  $hireprice->drumkitstock }}" required autocomplete="drumkitstock">

                                @error('drumkitstock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Cymbals cost') }}</label>
                            </div>
                            <div class="col-md-3">
                                <input id="cymbals" type="number" step="0.1" class="form-control @error('cymbals') is-invalid @enderror"
                                    name="cymbals" value="{{  $hireprice->cymbals }}" required autocomplete="cymbals">

                                @error('cymbals')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-3 text-md-right">
                            <label class="col-form-label text-md-right">{{ __('Stock') }}</label>
                            </div>

                            <div class="col-md-3">
                                <input id="cymbalsstock" type="number" step="1" class="form-control @error('cymbalsstock') is-invalid @enderror"
                                    name="cymbalsstock" value="{{  $hireprice->cymbalsstock }}" required autocomplete="cymbalsstock">

                                @error('cymbalsstock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                    </form><hr>
        </div>

        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
