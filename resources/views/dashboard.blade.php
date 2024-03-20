@extends('layouts.app')

@section('content')
    <div class="container">
        
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div>
                @if(auth()->user()->user_type === 'admin')
                    <div class="col-md-4 my-2">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Users: <b>{{ $users }}</b></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 my-2">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Hotels: <b>{{ $hotels }}</b></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 my-2">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Rooms: <b>{{ $rooms }}</b></h5>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
       
        <div class="card mt-3">
            <div class="card-header">
                <h5>Room Booking Request List</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Booked Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hotelRoomBookings as $key => $bookingRoom)
                                <tr>
                                    <td>{{ ++$key }} .</td>
                                    <td>{{ $bookingRoom->user->name }}</td>
                                    <td>{{ $bookingRoom->booked_at }}</td>
                                    <td>{{ ucfirst($bookingRoom->booked_status) }}</td>
                                    <td>
                                        @if(auth()->user()->user_type === 'admin' && $bookingRoom->booked_status === 'pending')
                                            <a href="{{ route('approve-booking-request', $bookingRoom->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Are you sure?')">Approved</a>
                                            <a href="{{ route('reject-booking-request', $bookingRoom->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Rejected</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">No records found...!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
