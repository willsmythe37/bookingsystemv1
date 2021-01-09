@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
                <h1>User Management</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h3>Search Database</h3>
                <h5>Entering a word here will search the database for a name, surname, band, email or phone number.</h5>
                    <br>
                <form id="serach" action="{{ route('admin.display')}}" method="GET">
                    {{ method_field('GET')}}
                    @csrf

                    <div class="form-group row">
                        <label
                            class="col-md-3 col-form-label text-md-right">{{ __('Search word') }}</label>

                        <div class="col-md-6">
                            <input id="search" maxlength="50" type="text"  placeholder="e.g. fred"
                                class="form-control @error('search') is-invalid @enderror" name="search"
                                value="{{ old('search') }}" autocomplete="search">

                            @error('search')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

        <button type="submit" class="btn btn-primary btn-sm">Search user database</button>
        </form>
        <hr>


                    <table class="table table-sm table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Info</th>
                            <th scope="col">Contacts</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                          <tr>
                              <th scope="row">{{ $user->id }}</th>
                              <td>{{ $user->name }} {{ $user->surname }}<br>Band: {{ $user->band }}</td>
                              <td><nobr><a href="tel:{{ $user->phonenumber }}">{{ $user->phonenumber }}</a></nobr><br><nobr><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></nobr></td>
                              <td><strong>
                                {{ implode(', ', $user->roles()->pluck('name')->toArray())  }}</strong></td>
                                <td>{{  date("d-m-Y", strtotime($user->last_login_at)) }}<br>{{  date("H:i", strtotime($user->last_login_at)) }}</td>
                                <td><div class="btn-group-vertical btn-block">
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
                      <div class="pagination pagination-centered justify-content-center">
                      {{ $users->links() }}</div>
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
