@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">
                <h2>Displaying Search Results</h2>
                <br>
                @if($search == null)

                @else
                <h5>You searched for <strong>'{{ $search }}'</strong>.</h5>
                <br>
                @endif

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-sm table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Band</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($display as $user)
                          <tr>
                              <th scope="row">{{ $user->id }}</th>
                              <td>{{ $user->name }} {{ $user->surname }}</td>
                              <td>{{ $user->band }}</td>
                              <td><nobr><a href="tel:{{ $user->phonenumber }}">{{ $user->phonenumber }}</a></nobr></td>
                              <td><nobr><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></nobr></td>
                              <td><strong>
                                {{ implode(', ', $user->roles()->pluck('name')->toArray())  }}</strong></td>
                                <td><div class="btn-group btn-block">
                                    <a class="btn btn-secondary btn-sm"
                                        href="{{ route('admin.history.usershow', $user->id) }}">Bookings</a>
                                        <a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.users.edit', $user->id) }}">Edit</a>
                                <a class="btn btn-warning btn-sm"
                                    href="{{ route('admin.users.show', $user->id) }}">Delete</a></div></td>
                                </tr>
                                @endforeach


                        </tbody>
                      </table>

                      <a href="{{ route('admin.users.index') }}"><button type="button" class="btn btn-secondary btn-sm">Back to users</button></a>
                      <br>







                <hr>
        </div>

        <div class="col-sm-2 sidenav">
        </div>

    </div>
</div>
@endsection
