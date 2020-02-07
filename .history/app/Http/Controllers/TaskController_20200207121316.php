<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        // $this->validate($request,[
        //     'name' => 'required|max:255|unique:tasks,name,'.$request -> user_id.',user_id',
        //     'due' => 'required'
        // ]);

    //     $user_id = Auth::id();
    //     $this->validate($request,[
    //      'name' => [
    //          'required',
    //          'max:255',
    //          Rule::unique('tasks')
    //         ],
    //      'due' => 'required'
    //  ]);


        $user_id = Auth::id();
           $this->validate($request,[
            'name' => [
                'required',
                'max:255',
                Rule::unique('tasks')->where('user_id', $user_id),
            })],
            'due' => 'required'
        ]);
        
        $task = new Task;
        $task->name = $request->name;
        $task->due = $request->due;
        $task->status = $request->status;
        $task->user_id = Auth::id();
        $task->save();
    
        return redirect('/tasks');
    }

    // タスクの削除
    public function destroy(Request $request, Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }

    //タスクの編集
    public function edit(Request $request, Task $task){
        

        return view('edit', [
            'task'=>$task
        ]);

    }

    public function update(Request $request, Task $task){
        
        
        $this->validate($request,[
            'name' => 'required|max:255|unique:tasks,name,'.$task -> name.',name',
            'due' => 'required'
        ]);

        $task->name = $request->name;
        $task->due = $request->due;
        $task->status = $request->status;
        $task->save();
        return redirect('/tasks');
    }
}