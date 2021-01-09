@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-sm-2 sidenav">
        </div>

        <div class="col-md-8">
                <h2>All Holidays History</h1>
                    <br>

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <label class="">{{ __('Create a new holiday') }}</label>
                                        <a class="btn btn-success btn-sm" href="{{ route('admin.holidays.create') }}">Create</a></p>
                    @if($holidays->count() == 0)
                    <h3>There are no holidays to view</h3>
                    @else



                    <table class="table table-sm table-light table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Timeslot</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($holidays as $holiday)
                          <tr>
                              <th scope="row">{{ $holiday->id }}</th>
                              <td><nobr>{{ $holiday->Holiday_title }}</nobr></td>
                              <td><strong>Start:</strong> {{ $holiday->Holiday_start}}<br><strong>End:</strong> {{ $holiday->Holiday_end }}<br><strong>Hours: </strong> {{ $hours = (strtotime($holiday->Holiday_end) - strtotime($holiday->Holiday_start)) / 3600 }}</td>
                                <td><div class="btn-group btn-block"><a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.holidays.edit', $holiday) }}">Edit</a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('admin.holidays.show', $holiday) }}">Delete</a></div></td>


                                @endforeach


                        </tbody>
                      </table>

                      <div class="pagination pagination-centered justify-content-center">
                      {{ $holidays->links() }}</div>
                      @endif
                        <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
            <hr>
        </div>
        <div class="col-sm-2 sidenav">
        </div>

    </div>
</div>
@endsection
