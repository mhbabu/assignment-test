@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @forelse ($hotel->hotelRooms as $room)
            <div class="col-md-3 my-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-center">
                    <h5 class="card-title">Room Number: <b>{{ $room->room_number }}</b></h5>
                    <a href="{{ url("hotel/$hotel->slug/room-$room->room_number/bookings/")}}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                    <h5 class="card-title mt-2">No Rooms are available...</h5>
                    </div>
                </div>
            </div>
                
        @endforelse 
    </div>
</div>
@endsection
