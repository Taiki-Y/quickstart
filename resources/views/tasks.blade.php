@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-12" style="margin: 0 20px">
      <div class="panel panel-default">
      @if(Auth::check())
        <div id="title" class="panel-heading">
        New Task
        </div>
        <div class="panel-body">
          <!-- New Task Form -->
          <form action="{{ url('task')  }}" method="POST" class="form-horizontal">
          {{ csrf_field() }}
            <!-- Task Name  -->
            <div class="form-group">
              <label for="task-name" class="col-sm-3 control-label">タスク内容<span class="must">*</span></label>
              <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('name') }}">
              </div>
            </div>
            @if($errors->has('name'))
              @foreach($errors->get('name') as $message)
              <p class="error-message">{{ $message }}</p>
                @endforeach
              @endif 
            <!-- DUE_DATE -->
            <div class="form-group">
              <label for="due" class="col-sm-3 control-label">期限<span class="must">*</span></label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="due" id="due" value="{{ old('due') }}" />
              </div> 
            </div>
            @if($errors->has('due'))
              @foreach($errors->get('due') as $message)
              <p class="error-message">{{ $message }}</p>
                @endforeach
              @endif
            <!-- Status -->
            <div class="form-group status">
              <label for="status" class="col-sm-3 control-label">ステータス</label>
              <div class="col-sm-6">
              <select name="status" id="status" class="form-control">
                <option value="1" >未着手</option>
                <option value="2">着手中</option>
              </select>
              </div>
            </div>
                <!-- Add Task Button -->
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-6">
                  <button type="submit" class="btn btn-default">
                    <i class="fa fa-btn fa-plus"></i>タスク追加
                  </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          @else
          <div></div>
          @endif
          <!-- TODO: Current Tasks -->
          @if(count($tasks) > 0)
          <div class="panel panel-default">
          <div class="panel-heading">
          現在のタスク
          <form class="form-inline" action="{{ url('/task/search')  }}">
            <div class="form-group">
              <input type="text" name="keyword" placeholder="キーワードを入力">
              <input type="submit" class="btn btn-default" value="検索" >
            </div>
          </form>
          </div>
              <div class="panel-body">
                <table id="sort_table" class="table table-striped task-table tablesorter">
                <!-- テーブルヘッダ --> 
                  <thead>
                    <th><a href="/tasks?sort=user_id">ユーザー名</a></th>
                    <th><a href="/tasks?sort=name">タスク名</a></th>
                    <th><a href="/tasks?sort=due">期限</a></th>
                    <th><a href="/tasks?sort=status">ステータス</a></th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                  </thead>
                  <!-- テーブル本体 --> 
                  <tbody>
                    @foreach ($tasks as $task)
                      <tr>
                    <!-- 投稿者名 -->
                    <td class="table-text">
                      <div>{{ $task->user->name }}</div>
                    </td>
                    <!-- タスク名 -->
                    <td class="table-text">
                      <div>{{ $task->name }}</div>
                    </td>
                    <!-- 期限 -->
                    <td class="table-text">
                      @if($task->due< $now && $task->status!==3  )
                        <div>{{ $task->due }}</div>
                        <span style="color: red;">タスクの期限が過ぎています</span>
                      @else
                        <div>{{ $task->due }}</div>
                      @endif
                    </td>
                    <!-- 状態 -->
                    <td class="table-text">
                      <div>{{\App\Enums\TaskState::getDescription($task->status)}}</div>
                    </td>
                      @if(Auth::id() === $task->user_id)
                      <!-- いいねボタン -->
                    <td>
                    <form action="{{ url('/tasks/like/') }}" method="GET">
                        {{ csrf_field() }}
                        <button class="good-button" type="button" class="btn">
                          いいね
                        </button>
                      </form>
                    </td>
                    <!-- TODO: 削除ボタン -->
                    <td>
                    <form action="{{ url('task/'.$task->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger" onClick="delete_alert(event);return false;">
                          <i class="fa fa-trash"></i> 削除
                        </button>
                      </form>
                    </td>
                    <td>
                    <form action="{{ url('task/'.$task->id.'/edit') }}" method="GET">
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 編集
                        </button>
                      </form>
                    </td>
                    </td>
                    @else
                    <td>
                    @endif
                    </td> 
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          @endif
        </div>
        <div class="d-flex justify-content-center text-center">
          {{ $tasks->appends(['sort' => $sort])->links() }}
        </div>
      </div>
    @endsection