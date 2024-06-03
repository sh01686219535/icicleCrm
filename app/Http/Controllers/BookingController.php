<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    //register
    public function register(Request $request){
        $authUser = Auth::guard('admin')->user()->name;
        $investor = Investor::where('name',$authUser)->select('id')->first();
        
        $booking = new Booking();
        $booking->person = request('person');
        $booking->start_date = request('start_date');
        $booking->end_date = request('end_date');
        $booking->investor_id = $investor->id;
        $booking->save();
      
        return back()->with('message','Booking Register Successfully');
    }
}
