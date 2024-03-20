@extends('layouts.app')
@section('header-css')
    {!! Html::style('assets/css/custom.css') !!}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datepicker.js/dist/datepicker.min.css">
    </head>
@endsection
@section('content')
    <div class="container">
        {!! Form::open(['route' => 'room-bookings.store', 'method' => 'post', 'id' => 'dataForm']) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 form-group my-2">
                    {!! Form::label('check_in_date', 'Check In Date', ['class' => 'required-star form-label']) !!}
                    {!! Form::text('check_in_date', '', [
                        'class' => $errors->has('check_in_date') ? 'form-control is-invalid' : 'form-control required',
                        'id' => 'checkInDate',
                        'placeholder' => 'YYYY-MM-DD',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
                <div class="col-md-3 form-group my-2">
                    {!! Form::label('check_out_date', 'Check Out Date', ['class' => 'required-star form-label']) !!}
                    {!! Form::text('check_out_date', '', [
                        'class' => $errors->has('check_out_date') ? 'form-control is-invalid' : 'form-control required',
                        'id' => 'checkOutDate',
                        'placeholder' => 'YYYY-MM-DD',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
                <div class="col-md-3 form-group my-2">
                    {!! Form::label('room_type_id', 'Room Type', ['class' => 'required-star form-label']) !!}
                    {!! Form::select('room_type_id', $roomTypes, '', [
                        'class' => $errors->has('room_type_id') ? 'form-control is-invalid' : 'form-control required',
                        'id' => 'roomType',
                        'placeholder' => 'Select Room Type',
                        'id' => 'roomType',
                    ]) !!}
                </div>
                <div class="col-md-3 form-group" style="margin-top: 12px">
                    <button type="submit" class="btn btn-primary mt-4 btn-submit">Book Now</button>
                </div>
            </div>
            <div class="row display-hotel-rooms">
                @forelse ($hotels as $hotel)
                    @foreach ($hotel->hotelRooms as $room)
                        <div class="col-md-3 my-2">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Room Number: <b>{{ $room->room_number }}</b></h5>
                                    <p class="card-text">Hotel: <b>{{ $hotel->name }}</b></p>
                                    <p class="card-text">Address: <b>{{ $hotel->address }}</b></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title mt-2">No Hotels are available...</h5>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('footer-script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  

    <script type="text/javascript">
        $(document).ready(function() {

            /********************************
             DATEPICKER SCRIPTING START HERE
            ********************************/
            $('#checkInDate, #checkOutDate').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0
            });

            /*********************************************
             ROOM AVAILABLE SCRIPTING OR FILTERING SCRIPT
             *********************************************/
            $('#checkInDate, #checkOutDate, #roomType').on('change', function() {
                const route = "{{ route('available-hotel-rooms') }}";
                getAvalilableRooms(this, route);
            });

            function getAvalilableRooms(e, route) {
                // $('.loading_data').hide();
                // $(e).after('<span class="loading_data">Loading...</span>');
                let self = $(e);
                let parentHtml = $(e).parent().parent().parent();
                const checkInDate = parentHtml.find('#checkInDate').val();
                const checkOutDate = parentHtml.find('#checkOutDate').val();
                const roomType = parentHtml.find('#roomType').val();

                $.ajax({
                    type: "GET",
                    url: route,
                    data: {
                        check_in_date: checkInDate,
                        check_out_date: checkOutDate,
                        room_type_id: roomType
                    },
                    success: function(response) {
                        if (response.status) {
                            $(".display-hotel-rooms").html(response.html);
                        }
                        // $(self).next().hide();
                    }
                });
            }
        });
    </script>
@endsection
