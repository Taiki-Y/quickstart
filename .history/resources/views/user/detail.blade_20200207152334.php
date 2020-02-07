@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-12" style="margin: 0 20px">
      <div class="panel panel-default">
      @if(Auth::check())
        <div class="panel-heading">
        {{$auth->name}}
        </div>
        <div class="panel-body">
          <!-- New Task Form -->
          <form action="{{ url('task')  }}" method="POST" class="form-horizontal">
          {{ csrf_field() }}
            <!-- ユーザー名  -->
            <div class="form-group">
              <span for="task-name" class="col-sm-3 control-label">ユーザー名</span>
              <div class="col-sm-6">
                <span>{{$auth->name}}</span>
              </div>
            </div>
            <!-- メールアドレス -->
            <div class="form-group">
            <span for="task-name" class="col-sm-3 control-label">メールアドレス</span>
              <div class="col-sm-6">
                <span>{{$auth->email}}</span>
              </div> 
            </div>
            <!-- パスワード -->
            <div class="form-group">
            <span for="task-name" class="col-sm-3 control-label">パスワード</span>
              <div class="col-sm-6">
                <span>{{$auth->password}}</span>
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
        </div>
      </div>
    @endsection