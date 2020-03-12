<?php

namespace App\Http\Controllers;

use App\Task;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Enums\PublishStateType;
use Response;

class TaskController extends Controller
{
    // 全タスクのリスト表示

    public function index(Request $request)
    {
        $sort = $request->sort;
        if (is_null($sort)) {
            $sort = 'id';
           }
        $now = date('Y-m-d H:i:s');
        $tasks = Task::orderBy($sort,'asc')->paginate(10);

        return view('tasks', [
        'tasks'=>$tasks,
        'now'=>$now,
        'sort'=>$sort
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
                Rule::unique('tasks')->where(function ($query) use ($user_id) {
                return $query->where('user_id', $user_id);
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

    // タスクの検索
    public function search(Request $request){
        $keyword = $request->input('keyword');


        if(!empty($keyword)){
            $hittasks = Task::orderBy('due', 'asc')
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->paginate(5);
        }else{
            echo "";
        }

        return view('searchresult',[
            'hittasks' =>$hittasks,
            'keyword' => $keyword
        ]);

    }

    // マイタスク
    public function mytasks(Auth $auth, Task $task){
        $auth = Auth::id();
        $mytasks = Task::where('user_id',$auth)->orderBy('due', 'asc')->paginate(2);
        return view('mytasks',[
            'tasks'=>$mytasks,
    ]);
    }

    public function like(Request $request,Task $task){
        $like = new Like;
        $like->user_id = Auth::id();

        $like->save();
    
    

        $response = array();
        $response["status"] = "OK";
        $response["message"] = $task->id;
        return Response::json($response);
    }

    
}
