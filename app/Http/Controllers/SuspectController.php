<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Investor;
use App\Models\AdminAuth;
use App\Models\Lead;
use App\Models\Task;
use App\Models\TeamLeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuspectController extends Controller
{
    //mplList
    public function mplList()
    {
        $data = array();
        $data['active_menu'] = 'mplList';
        $data['page_title'] = 'MPL list';
        $salesMan = Auth::guard('admin')->user()->name;
        $employee = Employee::where('name', $salesMan)->select('id')->first();
        $teamLeaderId = TeamLeader::where('name', $salesMan)->select('id')->first();


        $authId = Auth::guard('admin')->user()->id;
        $cmoId = AdminAuth::where('id',$authId)->Where('user_role',8)->first();
        $gm_id = AdminAuth::where('id',$authId)->Where('user_role',9)->first();

        if ($teamLeaderId) {
            $mplLead = Lead::where('status', 'MPL')
                ->where('team_leader', $teamLeaderId->id)
                ->get();
            return view('backend.suspect.mpl_list', compact('data', 'mplLead'));
        } elseif ($employee) {
            $mplLead = Lead::where('status', 'MPL')
                ->where('sales_officer', $employee->id)
                ->get();
            return view('backend.suspect.mpl_list', compact('data', 'mplLead'));
        
    } elseif ($cmoId) {
        $employees = Employee::where('cmo', $cmoId->id)->pluck('id')->toArray(); // Convert plucked IDs to array
        $mplLead  = Lead::whereIn('status', ['MPL']) // Pass status as an array
            ->whereIn('sales_officer', $employees)
            ->get();
            // dd($sglLead);
            return view('backend.suspect.mpl_list', compact('data', 'mplLead'));
    } elseif ($gm_id) {
        $employees = Employee::where('gm', $gm_id->id)->pluck('id')->toArray(); // Convert plucked IDs to array
        $mplLead  = Lead::whereIn('status', ['MPL']) // Pass status as an array
            ->whereIn('sales_officer', $employees)
            ->get();
            return view('backend.suspect.mpl_list', compact('data', 'mplLead'));
    }
        else {
            $mplLead = Lead::where('status', 'MPL')->get();
            return view('backend.suspect.mpl_list', compact('data', 'mplLead'));
        }
    }
    //sglList
    public function sglList()
    {
        $data = array();
        $data['active_menu'] = 'sglList';
        $data['page_title'] = 'SGL list';
        $salesMan = Auth::guard('admin')->user()->name;
        $employee = Employee::where('name', $salesMan)->select('id')->first();
        $teamLeaderId = TeamLeader::where('name', $salesMan)->select('id')->first();

        $authId = Auth::guard('admin')->user()->id;
        $cmoId = AdminAuth::where('id',$authId)->Where('user_role',8)->first();
        $gm_id = AdminAuth::where('id',$authId)->Where('user_role',9)->first();

        if ($teamLeaderId) {
            $sglLead = Lead::where('status', 'SGL')
                ->where('team_leader', $teamLeaderId->id)
                ->get();
            return view('backend.suspect.sgl_list', compact('data', 'sglLead'));
        } elseif ($employee) {
            $sglLead = Lead::where('status', 'SGL')
                ->where('sales_officer', $employee->id)
                ->get();
            return view('backend.suspect.sgl_list', compact('data', 'sglLead'));
        } elseif ($cmoId) {
        $employees = Employee::where('cmo', $cmoId->id)->pluck('id')->toArray(); // Convert plucked IDs to array
        $sglLead  = Lead::whereIn('status', ['SGL']) // Pass status as an array
            ->whereIn('sales_officer', $employees)
            ->get();
            // dd($sglLead);
            return view('backend.suspect.sgl_list', compact('data', 'sglLead'));
    } elseif ($gm_id) {
        $employees = Employee::where('gm', $gm_id->id)->pluck('id')->toArray(); // Convert plucked IDs to array
        $sglLead  = Lead::whereIn('status', ['SGL']) // Pass status as an array
            ->whereIn('sales_officer', $employees)
            ->get();
            return view('backend.suspect.sgl_list', compact('data', 'sglLead'));
    }
        else {
            $sglLead = Lead::where('status', 'SGL')->get();
            return view('backend.suspect.sgl_list', compact('data', 'sglLead'));
        }
    }
    //activeSuspectList
    public function activeSuspectList()
    {
        $data = array();
        $data['active_menu'] = 'activeList';
        $data['page_title'] = 'Active list';
        $salesMan = Auth::guard('admin')->user()->name;
        $authId = Auth::guard('admin')->user()->id;
        $employee = Employee::where('name', $salesMan)->select('id','name')->first();
        $teamLeaderId = TeamLeader::where('name', $salesMan)->select('id')->first();

        $authId = Auth::guard('admin')->user()->id;
        $cmoId = AdminAuth::where('id',$authId)->Where('user_role',8)->first();
        $gm_id = AdminAuth::where('id',$authId)->Where('user_role',9)->first();
        if ($teamLeaderId) {
            $sglLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])
                ->where('team_leader', $teamLeaderId->id)
                ->get();
            return view('backend.suspect.active_list', compact('data', 'sglLead'));
        }elseif($employee){
            $sglLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])
            ->where('employee_name', $employee->name)
            ->get();
        return view('backend.suspect.active_list', compact('data', 'sglLead'));

    } elseif ($cmoId) {
        $employees = Employee::where('cmo', $cmoId->id)->pluck('id');
        $sglLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])
            ->whereIn('employee_name', $employees)
            ->get();
            return view('backend.suspect.active_list', compact('data', 'sglLead'));
    } elseif ($gm_id) {
        $employees = Employee::where('gm', $gm_id->id)->pluck('id');
        $sglLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])
            ->whereIn('employee_name', $employees)
            ->get();
            return view('backend.suspect.active_list', compact('data', 'sglLead'));
    }
         else {
            $sglLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])->get();
            return view('backend.suspect.active_list', compact('data', 'sglLead'));
        }
    }
    //junk_suspect_list
    public function junk_suspect_list()
    {
        $data = array();
        $data['active_menu'] = 'junkList';
        $data['page_title'] = 'Junk list';
        $salesMan = Auth::guard('admin')->user()->name;
        $employee = Employee::where('name', $salesMan)->select('id','name')->first();
        $teamLeaderId = TeamLeader::where('name', $salesMan)->select('id')->first();

        $authId = Auth::guard('admin')->user()->id;
        $cmoId = AdminAuth::where('id',$authId)->Where('user_role',8)->first();
        $gm_id = AdminAuth::where('id',$authId)->Where('user_role',9)->first();

        if ($teamLeaderId) {
            $junkLead = Task::whereIn('status', ['Not Interested'])
                ->where('team_leader', $teamLeaderId->id)
                ->get();
            return view('backend.suspect.junk_list', compact('data', 'junkLead'));
        }elseif($employee){
            $junkLead = Task::whereIn('status', ['Not Interested'])
            ->where('employee_name', $employee->name)
            ->get();
        return view('backend.suspect.junk_list', compact('data', 'junkLead'));
        } elseif ($cmoId) {
            $employees = Employee::where('cmo', $cmoId->id)->pluck('id')->toArray(); 
            $junkLead  = Task::whereIn('status', ['Not Interested']) 
                ->whereIn('employee_name', $employees)
                ->get();
                // dd($sglLead);
                return view('backend.suspect.junk_list', compact('data', 'junkLead'));
        } elseif ($gm_id) {
            $employees = Employee::where('gm', $gm_id->id)->pluck('id')->toArray(); 
            $junkLead  = Task::whereIn('status', ['Not Interested']) 
                ->whereIn('employee_name', $employees)
                ->get();
                return view('backend.suspect.junk_list', compact('data', 'junkLead'));
        }
         else {
            $junkLead = Task::whereIn('status', ['Not Interested'])->get();
            return view('backend.suspect.junk_list', compact('data', 'junkLead'));
        }
    }
    //client_suspect_list
    public function client_suspect_list()
    {
        $data = array();
        $data['active_menu'] = 'clientList';
        $data['page_title'] = 'Client list';

        $salesMan = Auth::guard('admin')->user()->name;
        $teamLeaderId = TeamLeader::where('name', $salesMan)->select('id')->first();
        if ($teamLeaderId) {
            $clientList = Investor::where('status', 'accept')
                ->where('team_leader', $teamLeaderId->id)
                ->get();
            return view('backend.suspect.client_list', compact('data', 'clientList'));
        } else {
            $clientList = Investor::where('status', 'accept')->get();
            return view('backend.suspect.client_list', compact('data', 'clientList'));
        }
    }
    //mplEdit
    public function mplEdit($id)
    {
        $lead = Lead::find($id);
        $data = array();
        $data['active_menu'] = 'clientList';
        $data['page_title'] = 'MPL List';
        if (request()->isMethod('post')) {
            $lead->comments = request('comments');
            $lead->save();
            return redirect('/mpl/list')->with('message', 'MPL Lead Comments Updated Successfully');
        }
        return view('backend.suspect.mplEdit', compact('data', 'lead'));
    }
    //sglEdit
    public function sglEdit($id)
    {
        $lead = Lead::find($id);
        $data = array();
        $data['active_menu'] = 'clientList';
        $data['page_title'] = 'SGL List';
        if (request()->isMethod('post')) {
            $lead->comments = request('comments');
            $lead->save();
            return redirect('/sgl/list')->with('message', 'SGL Lead Comments Updated Successfully');
        }
        return view('backend.suspect.sglEdit', compact('data', 'lead'));
    }
    //activedit
    public function activedit($id)
    {
        $lead = Lead::find($id);
        $data = array();
        $data['active_menu'] = 'clientList';
        $data['page_title'] = 'SGL List';
        if (request()->isMethod('post')) {
            $lead->comments = request('comments');
            $lead->save();
            return redirect('/sgl/list')->with('message', 'Active Lead Comments Updated Successfully');
        }
        return view('backend.suspect.activeEdit', compact('data', 'lead'));
    }
    //junkEdit
    public function junkEdit($id)
    {
        $lead = Lead::find($id);
        $data = array();
        $data['active_menu'] = 'clientList';
        $data['page_title'] = 'SGL List';
        if (request()->isMethod('post')) {
            $lead->comments = request('comments');
            $lead->save();
            return redirect('/sgl/list')->with('message', 'Junk Lead Comments Updated Successfully');
        }
        return view('backend.suspect.junkEdit', compact('data', 'lead'));
    }
}
