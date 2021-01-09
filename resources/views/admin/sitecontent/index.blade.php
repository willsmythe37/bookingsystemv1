@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
                <h1>Site Content Management</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <table class="table table-sm table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">URL name</th>
                            <th scope="col">Title 1</th>
                            <th scope="col">Title 2</th>
                            <th scope="col">Title 3</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($sitecontents as $sitecontent)
                          <tr>
                              <th scope="row">{{ $sitecontent->id }}</th>
                              <td><nobr>/{{ $sitecontent->pagename }}</nobr></td>
                              <td>{{ $sitecontent->title1 }}</td>
                              <td>{{ $sitecontent->title2 }}</td>
                              <td>{{ $sitecontent->title3 }}</td>

                                <td><div class="btn-group btn-block"><a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.sitecontent.edit', $sitecontent->id) }}">Edit</a></div></td>
                                </tr>
                                @endforeach


                        </tbody>
                      </table>
                      <div class="pagination pagination-centered justify-content-center">
                      {{ $sitecontents->links() }}</div>
                      <br>

                      <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
                      <br>
                      <hr>
    </div>
    <div class="col-sm-2 sidenav">
    </div>
</div>
@endsection
