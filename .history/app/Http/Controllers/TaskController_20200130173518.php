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
}
