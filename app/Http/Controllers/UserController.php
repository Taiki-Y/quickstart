<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Newemail;
use Mail;
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

    public function detail(User $user){
        $auth = Auth::user();

        return view('user/detail',[
            'auth' => $auth
        ]);
    }
    
    public function edit(){
        $auth = Auth::user();
        return view('user/edit',[
            'auth' => $auth
        ]);
    }

    public function update(Request $request, Auth $auth){
        $auth = Auth::user();

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required'
        ]);

        $auth->name = $request->name;
        $auth->email = $request->email;
        $auth->save();

        return redirect('user/'.$auth->id.'/edit');
    }

    public function editname(Request $request, User $user){
        $auth = Auth::user();

        return view('user/editname',[
            'auth'=> $auth
        ]);
    }

    public function updatename(Request $request, Auth $auth){
        $auth = Auth::user();
        $auth->name = $request->name;
        $auth->save();

        return view('user/detail',[
            'auth' => $auth
        ]);
    }

}
