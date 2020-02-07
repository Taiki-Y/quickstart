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

    public function update(Request $request, Auth $auth, $id){

        $auth = User::find($id);

        // リクエストデータ受取
        
        $form = $request->all();
        
        // フォームトークン削除
        
        unset($form['_token']);
        
        // レコードアップデート
        
        $auth->fill($form)->save();
        return view('user/edit');
    }

  
 
    

    // // タスクの削除
    // public function destroy(Request $request, Task $task )
    // {
    //     $task->delete();

    //     return view('user/show');
    // }

    // //タスクの編集
    // public function edit(Request $request, Task $task){

    //     return view('user/edit', [
    //         'task'=>$task
    //     ]);
    // }

    // public function update(Request $request, Task $task){
    //     $task->name = $request->name;
    //     $task->due = $request->due;
    //     $task->status = $request->status;
    //     $task->save();
    //     return redirect('/tasks');
    // }
    
}
