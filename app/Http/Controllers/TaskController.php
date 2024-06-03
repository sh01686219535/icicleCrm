<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Lead;
use App\Models\Task;
use App\Models\TaskComents;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['active_menu'] = 'ourTeam';
        $data['page_title'] = 'Task List';
        $auth = Auth::guard('admin')->user()->id;
        $employee = Employee::where('authId', $auth)->select('id', 'name')->first();
        if ($employee) {
            $task = Task::where('employee_name', $employee->id)->get();
            $lead = Lead::all();
            return view('backend.task.task', compact('data', 'task', 'lead'));
        } else {
            $lead = Lead::all();
            $task = Task::all();
            return view('backend.task.task', compact('data', 'lead', 'task'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['active_menu'] = 'task';
        $data['page_title'] = 'Task List';
        $employee = Employee::all();
        $administrate = Auth::guard('admin')->user()->name;

        $salesMan = Employee::where('name', $administrate)->select('id')->first();
        if ($salesMan) {
            $salesManId  = $salesMan->id;
            $currentDateTime = new DateTime('now');
            $currentDate = $currentDateTime->format('Y-m-d');
            $leadUser = Lead::whereDate('created_at', $currentDate)
                ->where('sales_officer', $salesManId)
                ->select('full_name', 'id')
                ->get();
            $exitigleadUser = Lead::where('sales_officer', $salesManId)->whereDate('created_at', '<>', $currentDate)->select('full_name', 'id')->get();

            return view('backend.task.addTask', compact('leadUser', 'data', 'employee', 'administrate', 'exitigleadUser'));
        } else {
            $salesManId = Auth::guard('admin')->id();
            $currentDateTime = new DateTime('now');
            $currentDate = $currentDateTime->format('Y-m-d');
            $leadUser = Lead::whereDate('created_at', $currentDate)
                ->where('sales_officer', $salesManId)
                ->select('full_name', 'id')
                ->get();
            $exitigleadUser = Lead::where('sales_officer', $salesManId)->select('full_name', 'id')->get();
            return view('backend.task.addTask', compact('leadUser', 'data', 'employee', 'administrate', 'exitigleadUser'));
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $administrate = Auth::guard('admin')->user()->name;
        $salesMan = Employee::where('name', $administrate)->select('name', 'id')->first();
        $salesManName = $salesMan->name;
        $salesManId = $salesMan->id;

        $task = new Task();
        if ($request->lead_user) {
            $task->lead_user = $request->lead_user;
        } elseif ($request->exist_lead_user) {
            $task->lead_user = $request->exist_lead_user;
        }
        $task->todays_update  = $request->todays_update;
        $task->next_action  = $request->next_action;
        $task->status = $request->status;
        $task->employee_name = $salesManId;
        $task->review = $request->review;
        $task->lead_phone = $request->lead_phone;
        $task->team_leader = $request->team_leader;
        $task->next_action_date = $request->next_action_date;
        $task->save();
        $lastTask = Task::orderBy('id', 'desc')->first();
        $taskUserId = $lastTask->id;
        $coments = new TaskComents();
        $coments->emplyoee_id = $salesManId;
        $coments->task_id = $taskUserId;
        $coments->lead_user = $request->lead_user;
        $coments->todays_update = $request->todays_update;
        $coments->next_action = $request->next_action;
        $coments->next_action_date = $request->next_action_date;
        $coments->save();

        return redirect('/tasks')->with('message', 'Task Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        $administrate = Auth::guard('admin')->user()->name;

        $salesMan = Employee::where('name', $administrate)->select('id')->first();

        if ($salesMan) {
            $salesManId  = $salesMan->id;
            $leadUser = Lead::where('sales_officer', $salesManId)->select('full_name', 'id')->get();
            $data = [];
            $data['active_menu'] = 'task';
            $data['page_title'] = 'Task Update';
            return view('backend.task.taskEdit', compact('data', 'task', 'leadUser'));
        } else {
            $salesManId = Auth::guard('admin')->id();
            $leadUser = Lead::where('sales_officer', $salesManId)->select('full_name', 'id')->get();
            $data = [];
            $data['active_menu'] = 'ourTeam';
            $data['page_title'] = 'Task Update';
            return view('backend.task.taskEdit', compact('data', 'task', 'leadUser'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $administrate = Auth::guard('admin')->user()->name;
        $salesMan = Employee::where('name', $administrate)->select('name', 'id')->first();
        $salesManId = $salesMan->id;

        $task = Task::find($id);
        $task->lead_user = $request->lead_user;
        $task->todays_update  = $request->todays_update;
        $task->next_action  = $request->next_action;
        $task->status = $request->status;
        $task->save();

        $coments = new TaskComents();
        $coments->emplyoee_id = $salesManId;
        $coments->task_id = $task->id;
        $coments->lead_user = $request->lead_user;
        $coments->todays_update = $request->todays_update;
        $coments->next_action = $request->next_action;
        $coments->next_action_date = $request->next_action_date;
        $coments->save();
        return redirect('/tasks')->with('message', 'Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();
        return back()->with('message', 'Task Deleted Successfully');
    }
}
