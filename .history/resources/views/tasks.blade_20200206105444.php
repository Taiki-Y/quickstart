@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-10 mx-auto" style="margin: 0 20px">
      <div class="panel panel-default">
        <div class="panel-heading">
        New Task
        </div>
        <div class="panel-body">
          <!-- Display Validation Errors -->
          @include('common.errors')
          <!-- New Task Form -->
          <form action="{{ url('task')  }}" method="POST" class="form-horizontal">
          {{ csrf_field() }}
            <!-- Task Name  -->
            <div class="form-group">
              <label for="task-name" class="col-sm-3 control-label">タスク内容</label>
              <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
              </div>
            </div>
            <!-- DUE_DATE -->
            <div class="form-group">
              <label for="due" class="col-sm-3 control-label">期限</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="due" id="due" value="defaultDate: "today"" />
              </div>
            </div>
            <!-- Status -->
            <div class="form-group">
              <label for="status" class="col-sm-3 control-label">ステータス</label>
              <div class="col-sm-6">
                <select name="status" id="status">
                  <option value="未着手">未着手</option>
                  <option value="進行中">進行中</option>
                </select>
              </div>
            </div>
            @if(Auth::check())
                <!-- Add Task Button -->
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-6">
                  <button type="submit" class="btn btn-default">
                    <i class="fa fa-btn fa-plus"></i>タスク追加
                  </button>
                  </div>
                </div>
              @else
              <p style="text-align: center;">※タスクを投稿するにはログインしてください</p>
              @endif
              </form>
            </div>
          </div>
          <!-- TODO: Current Tasks -->
          @if(count($tasks) > 0)
          <div class="panel panel-default">
          <div class="panel-heading">
          現在のタスク
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
      </div>
    @endsection