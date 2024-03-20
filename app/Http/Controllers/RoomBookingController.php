<?php

namespace App\Http\Controllers;

use App\Models\HotelRoomBooking;
use App\Models\RoomBookingDetail;
use App\Models\User;
use App\Notifications\RoomBookingRequestNotification;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoomBookingController extends Controller
{
    public function roomBooking(Request $request)
    {
        $request->validate([
            'check_in_date'  => 'required|date|date_format:Y-m-d',
            'check_out_date' => 'required|date|after_or_equal:check_in_date|date_format:Y-m-d',
            'room_type_id'   =>  'required',
            'room_ids'       => 'required|array',
        ], [
            'room_ids.required' => 'No room selected.'
        ], [
            'room_type_id'      => 'room type',

        ]);

        try {
            DB::beginTransaction();

            $roomBooking            = new HotelRoomBooking();
            $roomBooking->user_id   = auth()->id();
            $roomBooking->booked_at = now();
            $roomBooking->save();

            foreach ($request->room_ids as $roomId) {
                $roomBookingDetail                        = new RoomBookingDetail();
                $roomBookingDetail->hotel_room_booking_id = $roomBooking->id;
                $roomBookingDetail->room_id               = $roomId;
                $roomBookingDetail->check_in_date         = $request->check_in_date;
                $roomBookingDetail->check_out_date         = $request->check_out_date;
                $roomBookingDetail->save();
            }
           
            DB::commit();

            Toastr::success('Your booking request sent');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Log::error('Database transaction failed: ' . $e->getMessage());
            Toastr::error('Something went wrong!');
            return redirect()->back();
        }
    }

    public function approvedRequest($roomId){
        $bookingRoom = HotelRoomBooking::find($roomId);
        $bookingRoom->update(['booked_status' => 'approved']);
        $user = User::where('id', $bookingRoom->user_id)->first();
        $user->notify((new RoomBookingRequestNotification($bookingRoom)));
        Toastr::success('Request approved');
        return redirect()->back();
    }

    public function rejectRequest($roomId){
        $bookingRoom = HotelRoomBooking::find($roomId);
        $bookingRoom->update(['booked_status' => 'rejected']);
        $user = User::where('id', $bookingRoom->user_id)->first();
        $user->notify((new RoomBookingRequestNotification($bookingRoom)));
        Toastr::success('Request rejected');
        return redirect()->back();
    }
}
