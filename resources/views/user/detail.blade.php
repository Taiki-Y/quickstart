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
            <!-- ユーザー名  -->
            <div class="form-group">
              <label class="col-sm-3 control-label">ユーザー名</label>
              <div class="col-sm-6 control-info">
                <span>{{$auth->name}}</span>
              </div>
              <a href="/user/{{Auth::user()->id}}/username/edit" class="btn btn-default">編集</a>
            </div>
            <!-- メールアドレス -->
            <div class="form-group">
            <label class="col-sm-3 control-label">メールアドレス</label>
              <div class="col-sm-6 control-info">
                <span>{{$auth->email}}</span>
              </div> 
              <a href="/user/{{Auth::user()->id}}/mailaddress/edit" class="btn btn-default">編集</a>
            </div>
            <!-- ユーザー名  -->
            <div class="form-group">
              <label class="col-sm-3 control-label">パスワード</label>
              <div class="col-sm-6 control-info">
                <span>****************</span>
              </div>
              <a href="/user/{{Auth::user()->id}}/password/reset" class="btn btn-default">編集</a>
            </div>
            </div>
        </div>
          @else
          <div></div>
          @endif
        </div>
      </div>
    @endsection