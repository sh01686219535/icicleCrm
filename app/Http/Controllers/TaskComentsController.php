<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskComents;
use Illuminate\Http\Request;

class TaskComentsController extends Controller
{
    //tasksComentDetails
    public function tasksComentDetails($id){
        $data = [];
        $data['active_menu'] = 'ourTeam';
        $data['page_title'] = 'Task List';
        $task = Task::find($id);
        $taskId = $task->id;
        $taskCommnts = TaskComents::where('task_id',$taskId)->get();
        return view('backend.task.comment_details',compact('data','taskCommnts'));
    }
}
