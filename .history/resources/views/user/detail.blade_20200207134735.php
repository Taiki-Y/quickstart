@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-12" style="margin: 0 20px">
      <div class="panel panel-default">
        <div class="panel-heading">
          {{$auth->name}}
        </div>
        <div class="form-group">
          <span class="col-sm-3 control-label">ユーザー名</span>
          <div class="col-sm-6">
            {{$auth->name}}
          </div> 
        </div>
        <div class="form-group">
          <span class="col-sm-3 control-label">メールアドレス</span>
          <div class="col-sm-6">
            {{$auth->email}}
          </div> 
        </div>
        <div class="form-group">
          <span class="col-sm-3 control-label">パスワード</span>
          <div class="col-sm-6">
            {{$auth->password}}
          </div> 
        </div>
    </div>
</div>
@endsection