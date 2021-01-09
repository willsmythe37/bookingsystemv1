@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
                <h1>Edit Page Contents</h1>
                <h4 style="color:red">Important!!!</h4>
                <p style="color:red">Do not insert HTML tags. (e.g. <strong>< h2> < p> </strong>)<br><br>
                    Do not insert anchor/links. (e.g. <strong>< a href="www.place.com"> Place.com < /a> </strong>)<br>This best we can do is text URLs like "https://www.bbc.co.uk/"</p>
                    <p style="color:red"><strong>Stay safe and only insert text into the fields below!</strong></p>

                    <form action="{{ route('admin.sitecontent.update',  $sitecontent) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        {{ method_field('PUT')}}

                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label text-md-right">{{ __('URL name') }}</label>

                            <div class="col-md-9">
                                <input id="pagename" maxlength="255" type="text"
                                    class="form-control" name="pagename"
                                    value="{{  $sitecontent->pagename }}" autocomplete="pagename" disabled>
                                <input id="pagename" maxlength="255" type="text"
                                    class="form-control @error('pagename') is-invalid @enderror" name="pagename"
                                    value="{{  $sitecontent->pagename }}" autocomplete="pagename" hidden>

                                @error('pagename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="col-md-3 col-form-label text-md-right">{{ __('Title 1') }}</label>

                            <div class="col-md-9">
                                <input id="title1" maxlength="255" type="text"
                                    class="form-control @error('title1') is-invalid @enderror" name="title1"
                                    value="{{  $sitecontent->title1 }}" autocomplete="title1">

                                @error('title1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Body 1') }}</label>

                            <div class="col-md-9">
                                <textarea spellcheck="true" rows="10" cols="50" id="body1" maxlength="10000" type="textarea" class="form-control @error('body1') is-invalid @enderror"
                                    name="body1" autocomplete="body1">{{  $sitecontent->body1 }}</textarea>

                                @error('body1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input name="show1" type="hidden" value="0">
                                    <input class="form-check-input" type="checkbox" name="show1" value="1"
                                    autocomplete="show1"
                                    @if(old('show1', $sitecontent->show1))
                                    checked
                                    @endif
                                    >

                                    <label class="form-check-label" >
                                        Select to show 'Title 1' and 'Body 1' on this page.
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
                                    @if(old('showimage1', $sitecontent->showimage1))
                                    checked
                                    @endif
                                    >


                                    <label class="form-check-label" >
                                        Select to show 'Image 1'. (This is displayed to the <strong>right</strong> of the section)
                                    </label>
                                    <div class="col-sm-4">
                                        <img src="/Images/uploaded/{{$sitecontent->image1}}" alt="Image" class="img-fluid">
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Title 2') }}</label>

                            <div class="col-md-9">
                                <input id="title2" maxlength="255" type="text" class="form-control @error('title2') is-invalid @enderror"
                                    name="title2" value="{{  $sitecontent->title2 }}" autocomplete="title2">

                                @error('title2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Body 2') }}</label>

                            <div class="col-md-9">
                                <textarea spellcheck="true" rows="10" cols="50" id="body2" maxlength="10000" type="textarea" class="form-control @error('body2') is-invalid @enderror"
                                    name="body2" autocomplete="body2">{{  $sitecontent->body2 }}</textarea>

                                @error('body2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input name="show2" type="hidden" value="0">
                                    <input class="form-check-input" type="checkbox" name="show2" value="1"
                                    autocomplete="show2"
                                    @if(old('show2', $sitecontent->show2))
                                    checked
                                    @endif
                                    >

                                    <label class="form-check-label">
                                        Select to show 'Title 2' and 'Body 2' on this page.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-3">
                                <label class="control-label"><strong>Select 'Image2'  </strong></label><br>
                                    <input type="file" name="image2" /><br>
                                    <small class="error">{{$errors->first('image2')}}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input name="showimage2" type="hidden" value="0">
                                    <input class="form-check-input" type="checkbox" name="showimage2" value="1"
                                    autocomplete="showimage2"
                                    @if(old('showimage2', $sitecontent->showimage2))
                                    checked
                                    @endif
                                    >


                                    <label class="form-check-label" >
                                        Select to show 'Image 2'. (This is displayed to the <strong>right</strong> of the section)
                                    </label>
                                    <div class="col-sm-4">
                                        <img src="/Images/uploaded/{{$sitecontent->image2}}" alt="Image" class="img-fluid">
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Title 3') }}</label>

                            <div class="col-md-9">
                                <input id="title3" maxlength="255" type="text" class="form-control @error('title3') is-invalid @enderror"
                                    name="title3" value="{{  $sitecontent->title3 }}" autocomplete="title3">

                                @error('title3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">{{ __('Body 3') }}</label>

                            <div class="col-md-9">
                                <textarea spellcheck="true" rows="10" cols="50" id="body3" maxlength="10000" type="text" class="form-control @error('body3') is-invalid @enderror"
                                    name="body3" autocomplete="body3">{{  $sitecontent->body3 }}</textarea>

                                @error('body3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input name="show3" type="hidden" value="0">
                                    <input class="form-check-input" type="checkbox" name="show3" value="1"
                                    autocomplete="show3"
                                    @if(old('show3', $sitecontent->show3))
                                    checked
                                    @endif
                                    >

                                    <label class="form-check-label" >
                                        Select to show 'Title 3' and 'Body 3' on this page.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-3">
                                <label class="control-label"><strong>Select 'Image3'  </strong></label><br>
                                    <input type="file" name="image3" /><br>
                                    <small class="error">{{$errors->first('image3')}}</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input name="showimage3" type="hidden" value="0">
                                    <input class="form-check-input" type="checkbox" name="showimage3" value="1"
                                    autocomplete="showimage3"
                                    @if(old('showimage3', $sitecontent->showimage3))
                                    checked
                                    @endif
                                    >


                                    <label class="form-check-label">
                                        Select to show 'Image 3'. (This is displayed to the <strong>right</strong> of the section)
                                    </label>
                                    <div class="col-sm-4">
                                        <img src="/Images/uploaded/{{$sitecontent->image3}}" alt="Image" class="img-fluid">
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        <a href="{{ route('admin.sitecontent.index') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                    </form><hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
