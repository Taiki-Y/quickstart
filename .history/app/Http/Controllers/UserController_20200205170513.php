<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function show(Request $request, ){
        $tasks = Task::where($task->user_id == Auth::id());

         return view('show', [
        'show'=>$tasks
    ]);
        
    }
}
