<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthAdmin;
use App\Models\AdminAuth;
use App\Models\Employee;
use App\Models\TeamLeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    //employeeList
    public function employee()
    {
        $data = array();
        $data['active_menu'] = 'employeeList';
        $data['page_title'] = 'Employee List';
        $employee = Employee::all();

        $authId = Auth::guard('admin')->user()->name;
        $teamLader = TeamLeader::where('name', $authId)->select('id')->first();
        if ($teamLader) {
            $employee = Employee::where('teamLeader_id', $teamLader->id)->get();
            return view('backend.employee.employeeList', compact('data', 'employee'));
        }
        return view('backend.employee.employeeList', compact('data', 'employee'));
    }
    //employeeDelete
    public function employeeDelete($id)
    {
        $employee = Employee::find($id);
        $image = $employee->image;
        if (File::exists($image)) {
            File::delete($image);
        }
        $employee->delete();
        return back()->with('message', 'Lead Deleted Successfully!!!');
    }
    //employeeEdit
    public function employeeEdit($id)
    {
        $employee = Employee::find($id);
        $data = array();
        $data['active_menu'] = 'employeeList';
        $data['page_title'] = 'Employee Update';
        if (request()->isMethod('post')) {
            try {

                if (request()->hasFile('image')) {
                    $extension = request()->file('image')->extension();
                    $photo_name = "backend/img/employee/" . uniqid() . '.' . $extension;
                    request()->file('image')->move('backend/img/employee', $photo_name);
                } else {
                    $photo_name = null;
                }
                $employee->name = request('name');
                $employee->email = request('email');
                $employee->phone = request('phone');
                $employee->designation = request('designation');
                if (request()->hasFile('image')) {
                    $employee->image = $photo_name;
                }
                $employee->save();
                return redirect('/employee')->with('message', 'Employee Updated Successfully');
            } catch (\Throwable $th) {
                // return back()->with('message','Unauthorize Data');
                return $th;
            }
        }
        return view('backend.employee.employeeEdit', compact('data', 'employee'));
    }
    //TeamLeader employeeList
    public function employeeList()
    {
        $data = array();
        $data['active_menu'] = 'employeeList';
        $data['page_title'] = 'Employee List';
        $authId = Auth::guard('admin')->user()->id;
        $teamLadergGm = TeamLeader::where('gm', $authId)->first();
        $teamLaderCmo = TeamLeader::where('cmo', $authId)->first();
        $teamLader = TeamLeader::where('authId', $authId)->first();
        if ($teamLadergGm) {
            $employee = Employee::where('gm', $teamLadergGm->gm)->get();
            
        }elseif($teamLaderCmo){
            $employee = Employee::where('cmo', $teamLaderCmo->cmo)->get();
        }elseif($teamLader){
            $employee = Employee::where('teamLeader_id', $teamLader->id)->get();
        }else{
            $employee = Employee::all();
        }
        
        return view('backend.employee.employeeList', compact('data', 'employee'));
    }
    //teamLeader
    public function teamLeader()
    {
        $data = array();
        $data['active_menu'] = 'teamLeader';
        $data['page_title'] = 'teamLeader List';
        $authId = Auth::guard('admin')->user()->id;
        $teamLadergGm = TeamLeader::where('gm', $authId)->first();
        $teamLaderCmo = TeamLeader::where('cmo', $authId)->first();
        if ($teamLadergGm) {
            $teamLeader = TeamLeader::where('gm',$teamLadergGm->gm)->get();
        }elseif ($teamLaderCmo) {
            $teamLeader = TeamLeader::where('cmo',$teamLaderCmo->cmo)->get();
        }else {
            $teamLeader = TeamLeader::all();
        }
       
        return view('backend.employee.teamLeaderList', compact('data', 'teamLeader'));
    }
    //teamEdit
    public function teamEdit($id)
    {
        $teamLader = TeamLeader::find($id);
        $data = array();
        $data['active_menu'] = 'employeeList';
        $data['page_title'] = 'Employee Update';
        if (request()->isMethod('post')) {
            try {

                if (request()->hasFile('image')) {
                    $extension = request()->file('image')->extension();
                    $photo_name = "backend/img/employee/" . uniqid() . '.' . $extension;
                    request()->file('image')->move('backend/img/employee', $photo_name);
                } else {
                    $photo_name = null;
                }
                $teamLader->name = request('name');
                $teamLader->email = request('email');
                $teamLader->phone = request('phone');
                $teamLader->designation = request('designation');
                if (request()->hasFile('image')) {
                    $teamLader->image = $photo_name;
                }
                $teamLader->save();
                return redirect('/employee')->with('message', 'TeamLader Updated Successfully');
            } catch (\Throwable $th) {
                // return back()->with('message','Unauthorize Data');
                return $th;
            }
        }
        return view('backend.employee.teamLeaderEdit', compact('data', 'teamLader'));
    }
    //teamDelete
    public function teamDelete($id)
    {
        $teamLeader = Employee::find($id);
        $image = $teamLeader->image;
        if (File::exists($image)) {
            File::delete($image);
        }
        $teamLeader->delete();
        return back()->with('message', 'TeamLeader Deleted Successfully!!!');
    }
    //cmoList
    public function cmoList()
    {
        $data = array();
        $data['active_menu'] = 'cmoList';
        $data['page_title'] = 'CMO List';
        $cmo = AdminAuth::where('user_role', 8)->get();
        return view('backend.employee.cmoList', compact('data', 'cmo'));
    }
    //cmoDelete
    public function cmoDelete($id)
    {
        $cmo = AdminAuth::find($id);
        $cmo->delete();
        return back()->with('message', 'CMO Deleted Successfully!!!');
    }
    //cmoEdit
    public function cmoEdit($id)
    {
        $data = array();
        $data['active_menu'] = 'cmoList';
        $data['page_title'] = 'CMO List';
        $cmo = AdminAuth::find($id);
        if(request()->isMethod('post')){
            if(request()->hasFile('image')){
                $extension = request()->file('image')->extension();
                $imageName = "backend/img/cmo/".uniqid().'.'.$extension;
                request()->file('image')->move('backend/img/cmo',$imageName);
                if(File::exists($cmo->image)){
                    File::delete($cmo->image);
                }
            }


            $cmo->update([
                'name' => request('name'),
                'email' => request('email'),
                'designation' => request('designation'),
                'image' => $imageName,
                'name' => request('name'),
            ]);
            return back()->with('message','CMO Updated Successfully');
        }
        return view('backend.employee.cmoEdit',compact('cmo','data'));
    }
    //gmList
    public function gmList()
    {
        $data = array();
        $data['active_menu'] = 'gmList';
        $data['page_title'] = 'GM List';
        $gm = AdminAuth::where('user_role', 9)->get();
        return view('backend.employee.gmList', compact('data', 'gm'));
    }
    //emDelete
    public function emDelete($id)
    {
        $cmo = AdminAuth::find($id);
        $cmo->delete();
        return back()->with('message', 'GM Deleted Successfully!!!');
    }
}
