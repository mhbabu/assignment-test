<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\RoomBookingDetail;
use App\Models\RoomType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['hotels']    = Hotel::with('hotelRooms')->where('status', 'active')->latest()->get();  //for large numbers records use pagination
        $data['roomTypes'] = RoomType::where('status', 'active')->pluck('name', 'id');
        return view('home', $data);
    }

    public function details($slug){
        $data['hotel'] = Hotel::with('hotelRooms')->where('slug', $slug)->first();
        return view('hotel.detail', $data);
    }

    public function getAvailableRooms(Request $request){
        $checkInDate  = $request->input('check_in_date');
        $checkOutDate = $request->input('check_out_date');
        $roomTypeId   = $request->input('room_type_id');

        $hotelRooms   = HotelRoom::query();
        if(isset($checkInDate) && isset($checkOutDate)){
            $bookingRoomIds = RoomBookingDetail::where('check_in_date', '<=', $checkInDate)
            ->where('check_out_date', '>=', $checkOutDate)->pluck('room_id');
            $hotelRooms->whereNotIn('id', $bookingRoomIds);
        }
    
         
        if(isset($roomTypeId))$hotelRooms->where('room_type_id', $roomTypeId);
        $data['hotelRooms'] = $hotelRooms->get();


        return response()->json([
            'status'  => true,
            'html'    => view('hotel.available-room', $data)->render()
        ]);
        
    }
}
