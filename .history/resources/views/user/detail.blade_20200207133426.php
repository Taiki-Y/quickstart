@extends('layouts.app')
@section('content')
  <div class="panel-heading">
    {{$user->name}}
  </div>
  <div class="form-group">
    <span class="col-sm-3 control-label">ユーザー名</span>
    <div class="col-sm-6">
      {{$user->name}}
    </div> 
  </div>
  <div class="form-group">
    <span class="col-sm-3 control-label">メールアドレス</span>
    <div class="col-sm-6">
      {{$user->email}}
    </div> 
  </div>
@endsection