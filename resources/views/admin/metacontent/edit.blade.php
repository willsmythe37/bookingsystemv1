@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
            <br><br><br>
                <h1>Edit Site Metadata tags</h1>
                <p>The contents below originate within the 'head' section of this site's web pages.<br>This information is often scanned by search engines</p>


                    <form action="{{ route('admin.metacontent.update',  $metacontent) }}" method="POST">
                        @csrf
                        {{ method_field('PUT')}}

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-9">
                                <input id="title" maxlength="255" type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{  $metacontent->title }}" required autocomplete="title">
                                <p>The 'title' is shown in the browser's title bar or in the page's tab.</p>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-9">
                                <input id="description" maxlength="255" type="textarea" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{  $metacontent->description }}" required autocomplete="description">
                                <p>Define a description of your web page.</p>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label text-md-right">{{ __('Keywords') }}</label>

                            <div class="col-md-9">
                                <input id="keywords" maxlength="255" type="text"
                                    class="form-control @error('keywords') is-invalid @enderror" name="keywords"
                                    value="{{  $metacontent->keywords }}" required autocomplete="keywords">
                                <p>Define keywords for search engines.</p>
                                @error('keywords')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Author') }}</label>

                            <div class="col-md-9">
                                <input id="author" maxlength="255" type="text" class="form-control @error('author') is-invalid @enderror"
                                    name="author" value="{{  $metacontent->author }}" required autocomplete="author">
                                <p>Define the author of a page.</p>
                                @error('author')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Refresh') }}</label>

                            <div class="col-md-9">
                                <input id="refresh" maxlength="255" type="textarea" class="form-control @error('refresh') is-invalid @enderror"
                                    name="refresh" value="{{  $metacontent->refresh }}" required autocomplete="refresh">
                                <p>Refresh document every 'x' seconds. Consider that you may wish to allow enough time for a user to complete a booking.
                                <br>Default is '600'</p>
                                @error('refresh')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <H5>The value's entered below are extremely important. Only amend if you know what you're doing!</h5><br>

                            <div class="form-group row">
                                <label
                                    class="col-md-3 col-form-label text-md-right">{{ __('Custom CSS') }}</label>

                                <div class="col-md-9">
                                    <textarea spellcheck="true" rows="10" cols="50" id="customCSS" maxlength="14500" type="text"
                                        class="form-control" name="customCSS"
                                        autocomplete="customCSS">{{  $metacontent->customCSS }}</textarea>
                                    <p>Custom CSS to style the website.</p>


                                    @error('customCSS')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Character set') }}</label>

                            <div class="col-md-9">
                                <input id="charset" maxlength="255" type="text"
                                    class="form-control" name="charset"
                                    value="{{  $metacontent->charset }}" required autocomplete="charset">
                                <p>The charset attribute specifies the character encoding for the HTML document.<br>Default is 'UTF-8'</p>


                                @error('charset')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Viewport') }}</label>

                            <div class="col-md-9">
                                <input id="viewport" maxlength="255" type="text" class="form-control @error('viewport') is-invalid @enderror"
                                    name="viewport" value="{{  $metacontent->viewport }}" required autocomplete="viewport">
                                <p>Setting the viewport to make your website look good on all devices.<br> Default is 'width=device-width, initial-scale=1.0'</p>
                                @error('viewport')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                    </form><hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
