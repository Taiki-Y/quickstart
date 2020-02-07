<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function show(Request $request, Task $task, User $user ){
        $tasks = Auth::user()->tasks()->get();

         return view('user/show', [
            'tasks'=>$tasks
    ]);
        
    }

    //タスクの編集
    public function edit(Request $request, Task $task){

        return view('user/edit');
    }

    public function update(Request $request, Task $task){
        $task->name = $request->name;
        $task->due = $request->due;
        $task->status = $request->status;
        $task->save();
        return redirect('/tasks');
    }
    
}
