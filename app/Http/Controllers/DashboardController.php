<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\HotelRoomBooking;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['users']  = User::where('user_type', 'user')->count();
        $data['hotels'] = Hotel::count();
        $data['rooms']  = HotelRoom::count();

        $hotelRoomBookings = HotelRoomBooking::query();
        if(auth()->user()->user_type === 'user' ){
            $hotelRoomBookings->where('user_id', auth()->id());
        }

        $data['hotelRoomBookings'] = $hotelRoomBookings->latest()->get(); // use paginate for large number of records
        return view('dashboard', $data);
    }
}
