<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Newemail;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;



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
    

    public function editmailaddress(Request $request, User $user){
        $auth = Auth::user();

        return view('user/editmailaddress',[
            'auth'=> $auth
        ]);
    }


    public function showresetform(){
        $auth = Auth::user();

        return view('user/resetpassword',[
            'auth'=> $auth
        ]);
    }

    public function resetpassword(Request $request){
        //現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
        }

        //現在のパスワードと新しいパスワードが違っているかを調べる
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        //パスワードのバリデーション。新しいパスワードは6文字以上、new-password_confirmationフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with('change_password_success', 'パスワードを変更しました。');
    }


}
