
    @foreach ($hotelRooms as $room)
        <div class="col-md-3 my-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <label class="my-2"><input type="checkbox" class="select-room" name="room_ids[]" value="{{ $room->id}}"> Select</label>

                    <h5 class="card-title">Room Number: <b>{{ $room->room_number }}</b></h5>
                    <p class="card-text">Hotel: <b>{{ $room->hotel->name }}</b></p>
                    <p class="card-text">Address: <b>{{ $room->hotel->address }}</b></p>
                </div>
            </div>
        </div>
    @endforeach