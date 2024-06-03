<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    //facilitiesApproval
    public function facilitiesApproval(){
        $data = array();
        $data['active_menu'] = 'facilitiesApproval';
        $data['page_title'] = 'Facilities Approval';
        $facilities = Booking::where('status','pending')->get();
        return view('backend.facilities.approvalList',compact('data','facilities'));
    }
    // /approveFacilities
    public function approveFacilities($id){
       $booking = Booking::find($id);
       $booking->update([
        'status' => 'approved'
       ]);
       return back()->with('message','Investor Facilities Updated');
    }
    //facilitiesDelete
    public function facilitiesDelete($id){
        Booking::find($id)->delete();
       return back()->with('message','Investor Facilities Deleted');
    }
    //facilitiesAdminShow
    public function facilitiesAdminShow($id){
       $booking = Booking::with('investor')->find($id);
       $data = array();
       $data['active_menu'] = 'facilitiesApproval';
       $data['page_title'] = 'Facilities Approval';

        return view('backend.facilities.facilities_view',compact('data','booking'));
    }
}
