@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-12" style="margin: 0 20px">
      <div class="panel panel-default">
      @if(Auth::check())
        <div class="panel-heading">
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
                <select name="status" id="status">
                  <option value="未着手">未着手</option>
                  <option value="進行中">進行中</option>
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
              <input type="text" name="keyword">
              <input type="submit" value="検索" >
            </div>
          </form>
          </div>
              <div class="panel-body">
                <table class="table table-striped task-table">
                <!-- テーブルヘッダ --> 
                  <thead>
                    <th>ユーザー名</th>
                    <th>タスク名</th>
                    <th>期限</th>
                    <th>ステータス</th>
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
                      <div>{{ $task->due }}</div>
                    </td>
                    <!-- 状態 -->
                    <td class="table-text">
                      <div>{{ $task->status }}</div>
                    </td>
                    <td>
                      @if(Auth::id() === $task->user_id)
                    <!-- TODO: 削除ボタン -->
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
          {{ $tasks->links() }}
        </div>
      </div>
    @endsection