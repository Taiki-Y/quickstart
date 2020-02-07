<?php

namespace App\Http\Controllers;

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
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
        ]);
        
        if($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }
        $task = new Task;
        $task->name = $request->name;
        $task->save();
    
        return redirect('/');
    }
}
