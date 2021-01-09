@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
                <h1>Weblink Management</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <label class="">{{ __('Create a new weblink') }}</label>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.weblinks.create') }}">Create</a></p>

                    @if($weblinks->count() == 0)
                    <h3>There are no weblinks being displayed</h3>
                    @else

                    <table class="table table-sm table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Short description</th>
                            <th scope="col">WebURL/Link</th>
                            <th scope="col">Sort order</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($weblinks as $weblink)
                          <tr>
                              <th scope="row">{{ $weblink->id }}</th>
                              <td><nobr>{{ $weblink->name }}</nobr></td>
                              <td>{{ $weblink->shortdescription }}</td>
                              <td>{{ $weblink->webURL }}</td>

                              <td>{{ $weblink->order }}</td>

                                <td><div class="btn-group btn-block"><a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.weblinks.edit', $weblink->id) }}">Edit</a>
                                <a class="btn btn-warning btn-sm"
                                    href="{{ route('admin.weblinks.show', $weblink->id) }}">Delete</a></div></td>
                                </tr>
                                @endforeach


                        </tbody>
                      </table>
                      <div class="pagination pagination-centered justify-content-center">
                      {{ $weblinks->links() }}</div>
                      @endif
                      <br>

                      <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                      <br>

                        <hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>
    </div>
</div>
@endsection
