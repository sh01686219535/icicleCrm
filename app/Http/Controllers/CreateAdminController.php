<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthAdmin;
use App\Models\Admin;
use App\Models\AdminAuth;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\TeamLeader;
use Illuminate\Support\Facades\Auth;

class CreateAdminController extends Controller
{
    public function adminList()
    {
        $data = array();
        $data['active_menu'] = 'adminList';
        $data['page_title'] = 'Employee List';
        $authId = Auth::guard('admin')->user()->id;
        $authUser = AdminAuth::find($authId);
    
        if ($authUser->user_role == 2) {
            $list = AdminAuth::where('user_role', '!=', 3)->latest()->get();
        } else {
            $list = AdminAuth::latest()->get();
        }
        
        return view('backend.createAdmin.adminList', compact('list', 'data'));
    }


    public function createAdmin()
    {
        $data = array();
        $data['active_menu'] = 'adminCreate';
        $data['page_title'] = 'Admin Create';
        $cmo = AdminAuth::where('user_role', 8)->get();
        $gm = AdminAuth::where('user_role', 9)->get();
        $adminCreate = Role::all();
        $teamLeader = TeamLeader::all();
        return view('backend.createAdmin.createAdmin', compact('adminCreate', 'data', 'teamLeader','cmo','gm'));
    }

    public function adminCreate()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'user_role' => 'required',
        ]);
        $admin = AdminAuth::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_role' => request('user_role'),
            'designation' => request('designation'),
            'booking_ratio' => request('booking_ratio'),
            'installment_ratio' => request('installment_ratio'),
            'team' => request('team'),
            'teamLeader_id' => request('teamLeader_id'),
        ]);
        $admin->roles()->attach(request('user_role'));
        $authAdminId = AdminAuth::all()->last()->id;

        if ((request('user_role') == '6')) {
            Employee::create([
                'name' => request('name'),
                'email' => request('email'),
                'phone' => request('phone'),
                'designation' => request('designation'),
                'team' => request('team'),
                'report_to' => request('report_to'),
                'target_money' => request('target_money'),
                'target_S_to_C' => request('target_S_to_C'),
                'target_installment' => request('target_installment'),
                'teamLeader_id' => request('teamLeader_id'),
                'cmo' => request('cmo'),
                'gm' => request('gm'),
                'authId' => $authAdminId,
            ]);
        }
        if ((request('user_role') == '5')) {
            TeamLeader::create([
                'name' => request('name'),
                'email' => request('email'),
                'phone' => request('phone'),
                'designation' => request('designation'),
                'report_to' => request('report_to'),
                'team' => request('team'),
                'target_money' => request('target_money'),
                'target_S_to_C' => request('target_S_to_C'),
                'target_installment' => request('target_installment'),
                'cmo' => request('cmo'),
                'gm' => request('gm'),
                'authId' => $authAdminId,
            ]);
        }
        return to_route('adminList');
    }
    public function showEditAdmin($id)
    {
        $data = array();
        $data['active_menu'] = 'adminEdit';
        $data['page_title'] = 'Admin Edit';
        $adminCreate = Role::get();
        $test = AdminAuth::find($id);
        $name = $test->name;
        $leader = TeamLeader::all();
        $employee = Employee::where('name', $name)->first();
        $teamLeader = TeamLeader::where('name', $name)->first();
        $cmo = AdminAuth::where('user_role', 8)->get();
        $gm = AdminAuth::where('user_role', 9)->get();
        return view('backend.createAdmin.editAdmin', compact('leader', 'test', 'adminCreate', 'data', 'employee', 'teamLeader','cmo','gm'));
    }

    public function editAdmin(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'user_role' => 'required',
        ]);
        $test = AdminAuth::find($id);
        $test->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'designation' => request('designation'),
            'user_role' => request('user_role'),
            'booking_ratio' => request('booking_ratio'),
            'installment_ratio' => request('installment_ratio'),
            'teamLeader_id' => request('teamLeader_id'),
        ]);
        $test = $test->id;
        $employee = Employee::where('authId', $test)->first();
        $teamLeader = TeamLeader::where('authId', $test)->first();
        if ($employee) {
            $employee->update([
                'name' => request('name'),
                'email' => request('email'),
                'phone' => request('phone'),
                'designation' => request('designation'),
                'team' => request('team'),
                'report_to' => request('report_to'),
                'target_money' => request('target_money'),
                'target_S_to_C' => request('target_S_to_C'),
                'target_installment' => request('target_installment'),
                'teamLeader_id' => request('teamLeader_id'),
                'cmo' => request('cmo'),
                'gm' => request('gm'),
            ]);
        } elseif ($teamLeader) {
            $teamLeader->update([
                'name' => request('name'),
                'email' => request('email'),
                'phone' => request('phone'),
                'designation' => request('designation'),
                'report_to' => request('report_to'),
                'team' => request('team'),
                'target_money' => request('target_money'),
                'target_S_to_C' => request('target_S_to_C'),
                'target_installment' => request('target_installment'),
                'cmo' => request('cmo'),
                'gm' => request('gm'),
            ]);
        }else{
            
        }
        return redirect()->route('adminList');
    }
    public function deleteAdmin($id)
    {

        AdminAuth::findOrFail($id)->delete();
        return redirect()->back();
    }
}
