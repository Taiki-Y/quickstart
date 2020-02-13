@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-12" style="margin: 0 20px">
      <div class="panel panel-default">
        <div class="panel-body">
         <p>メールアドレスを変更しました</p>
         <a href="/user/{{Auth::user()->id}}" class="btn btn-default">マイページに戻る</a>
            </div>
          </div>
        </div>
      </div>
    @endsection