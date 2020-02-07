<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 全タスクのリスト表示

    public function index(Request $request)
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks', [
        'tasks'=>$tasks
    ]);
    }

    // 新タスク作成
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);
        
        $task = new Task;
        $task->name = $request->name;
        $task->save();
    
        return redirect('/tasks');
    }

    // タスクの削除
    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }

    public function showEditForm(Request $request, int $id, int $task_id){
        $editedTask = Task::find($task);

        return view('/edit', [
            'edit' => $editedTask
        ]);
    }
}
