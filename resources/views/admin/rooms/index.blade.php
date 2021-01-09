@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 sidenav">
        </div>
        <div class="col-md-8">
                <h1>Room Management</h1>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <label class="">{{ __('Create a new room') }}</label>
                    <a class="btn btn-success btn-sm" href="{{ route('admin.rooms.create') }}">Create</a></p>

                    @if($rooms->count() == 0)
                    <h3>There are no rooms available</h3>
                    @else

                    <table class="table table-sm table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Short description</th>
                            <th scope="col">Long description</th>
                            <th scope="col">Available</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($rooms as $room)
                          <tr>
                              <th scope="row">{{ $room->id }}</th>
                              <td><nobr>{{ $room->roomname }}</nobr></td>
                              <td>{{ $room->shortdescription }}</td>
                              <td>{{ $room->longdescription }}</td>
                              <td>
                                @if($room->available == 0) No
                                @else Yes
                                @endif
                                </td>
                              <td>
                                  <div class="btn-group btn-block">
                                      <a class="btn btn-primary btn-sm" href="{{ route('admin.rooms.edit', $room->id) }}">Edit</a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('admin.rooms.show', $room->id) }}">Delete</a>
                                </div>
                            </td>
                                </tr>
                                @endforeach


                        </tbody>
                      </table>
                      <div class="pagination pagination-centered justify-content-center">
                      {{ $rooms->links() }}</div>
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
