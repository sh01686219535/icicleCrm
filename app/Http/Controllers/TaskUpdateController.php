<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskUpdateController extends Controller
{
    //statusUpdate
    public function statusUpdate($id){
       $task = Task::find($id);
       $task->update_status = 'approved';
       $task->save();
       return back()->with('message','Task Update Successfully');
    }
}
