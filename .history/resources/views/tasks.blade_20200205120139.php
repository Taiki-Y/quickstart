@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-8">
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
              <label for="task-name" class="col-sm-3 control-label">TaskName</label>
              <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
              </div>
            </div>
            <!-- DUE_DATE -->
            <div class="form-group">
              <label for="due" class="col-sm-3 control-label">Due</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="due" id="due" value="{{ old('due') }}" />
              </div>
            </div>
            <!-- Status -->
            <div class="form-group">
              <label for="status" class="col-sm-3 control-label">Status</label>
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
                    <i class="fa fa-btn fa-plus"></i>Add Task
                  </button>
                  </div>
                </div>
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
                    <th>UserName</th>
                    <th>TaskName</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                  </thead>
                  <!-- テーブル本体 --> 
                  <tbody>
                    @foreach ($tasks as $task)
                      <tr>
                    <!-- 投稿者名 -->
                    <td class="table-text">
                      <div>{{ $task->user_id.name }}</div>
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
                      @if(Auth::check())
                    <!-- TODO: 削除ボタン -->
                    <td>
                      <form action="{{ url('task/'.$task->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">
                          <i class="fa fa-trash"></i> Delete
                        </button>
                      </form>
                    </td>
                    <td>
                    <form action="{{ url('task/'.$task->id.'/edit') }}" method="GET">
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                        </button>
                      </form>
                    </td>
                    </td>
                    @else
                    <td>ログインしてください
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