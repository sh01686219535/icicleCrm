<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Target;
use App\Models\TeamLeader;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TargetController extends Controller
{
    //targetAssignAdmin
    public function targetAssignAdmin()
    {
        $data = array();
        $data['active_menu'] = 'assignAdmin';
        $data['page_title'] = 'Target Assign';
        $authId = Auth::guard('admin')->user()->id;
        if ($authId) {
            $teamLeader = TeamLeader::where('gm', $authId)->orWhere('cmo', $authId)->get();
            $user_role = Auth::guard('admin')->user()->user_role;
        if ($user_role == 2 || $user_role == 3) {
            $teamLeader = TeamLeader::all();
        }
        }else {
            $teamLeader = TeamLeader::all();
        }
        $target = Target::where('employee_id', null)->get();
        return view('backend.target.adminTarget', compact('data', 'teamLeader', 'target'));
    }
    //storeAssignAdmin
    public function storeAssignAdmin(Request $request)
    {
        $authId = Auth::guard('admin')->user()->id;
        $teamLeader = TeamLeader::where('gm', $authId)->orWhere('cmo', $authId)->select('id', 'gm', 'cmo')->first();
        if ($teamLeader) {
            $target = new Target();
            $target->teamLeader_id = $request->teamLeader_id;
            if ($teamLeader->gm) {
                $target->gm_id = $teamLeader->gm;
            } else {
                $target->cmo_id = $teamLeader->cmo;
            }
            $target->targetAmount = $request->targetAmount;
            $target->targetDate = $request->targetDate;
            $target->save();
        }
        // teamLEader
        $teamLeaderId = TeamLeader::where('id', $request->teamLeader_id)->first();
        $teamLeaderId->target_money = $request->targetAmount;
        $teamLeaderId->save();

        return back()->with('message', 'Target Assign Successfully');
    }
    //targetAdminEdit
    public function targetAdminEdit(Request $request, $id)
    {
        $target = Target::find($id);
        $data = array();
        $data['active_menu'] = 'assignAdmin';
        $data['page_title'] = 'Target Assign Update';
        $teamLeader = TeamLeader::all();
        return view('backend.target.adminTargetEdit', compact('data', 'target', 'teamLeader'));
    }
    //updateAssignTarget
    public function updateAssignTarget(Request $request, $id)
    {
        $target = Target::find($id);
        $target->teamLeader_id = $request->teamLeader_id;
        $target->targetAmount = $request->targetAmount;
        $target->save();
        return redirect('/target/assign/admin')->with('message', 'Target Assign Update Successfully');
    }
    //targetAdminDelete
    public function targetAdminDelete($id)
    {
        Target::find($id)->delete();
        return back()->with('message', 'Target Assign Deleted Successfully');
    }
    //TeamLeaderShow
    public function TeamLeaderShow()
    {
        $data = array();
        $data['active_menu'] = 'assignTeam';
        $data['page_title'] = 'Target Assign';
        $authId = Auth::guard('admin')->user()->id;
        $employee = Employee::all();
        $target = Target::where('teamLeader_id', null)->get();
        $salesMans = Target::where('employee_id', null)->first();

        $targetMoney = Target::where('teamLeader_id', null)->sum('targetAmount');
        if($salesMans) {
            if($salesMans->targetAmount) {
                $salesMan = (float)$salesMans->targetAmount - (float)$targetMoney;
            } else {
                $salesMan = 0;
            }
        } else {
            $salesMan = 0;
        }

        return view('backend.target.LeaderShow', compact('data', 'employee', 'target', 'salesMan'));
    }
    //TeamLeaderStore
    public function TeamLeaderStore(Request $request)
    {
        $authId = Auth::guard('admin')->user()->id;
        $teamLeader = TeamLeader::where('authId', $authId)->select('id', 'gm', 'cmo')->first();

        if ($teamLeader) {
            $target = new Target();
            $target->teamLeader_id = $teamLeader->id;
            $target->employee_id = $request->employee_id;
            if ($teamLeader->gm) {
                $target->gm_id = $teamLeader->gm;
            } else {
                $target->cmo_id = $teamLeader->cmo;
            }
            $target->targetAmount = $request->targetAmount;
            $target->targetDate = $request->targetDate;
            $target->save();
        }

        $teamLeaderId = Employee::where('id', $request->employee_id)->first();
        $teamLeaderId->target_money = $request->targetAmount;
        $teamLeaderId->save();
        return back()->with('message', 'Target Assign Successfully');
    }
    //TeamLeaderUpdate
    public function TeamLeaderEdit($id)
    {
        $data = array();
        $data['active_menu'] = 'assignTeam';
        $data['page_title'] = 'Target Assign Update';
        $target = Target::find($id);
        $employee = Employee::all();
        return view('backend.target.teamTargetEdit', compact('data', 'target', 'employee'));
    }
    //TeamLeaderUpdate
    public function TeamLeaderUpdate(Request $request, $id)
    {
        $target = Target::find($id);
        $target->employee_id = $request->employee_id;
        $target->targetAmount = $request->targetAmount;
        $target->save();
        return redirect('/target/assignt/eamLeader')->with('message', 'Target Assign Update Successfully');
    }
    //TeamLeaderDelete
    public function TeamLeaderDelete($id)
    {
        Target::find($id)->delete();
        return back()->with('message', 'Target Assign Deleted Successfully');
    }
}
