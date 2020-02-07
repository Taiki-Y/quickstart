<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function show(Request $request, Task $task ){
        $tasks = Task::where(user_id === Auth::id())->get();

         return view('show', [
            'tasks'=>$tasks
    ]);
        
    }
}
