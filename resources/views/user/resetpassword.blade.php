@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-12" style="margin: 0 20px">
      <div class="panel panel-default">
        <div class="panel-heading">
        {{$auth->name}}
        </div>
        @if (session('change_password_error'))
          <div class="container mt-2">
            <div class="alert alert-danger">
              {{session('change_password_error')}}
            </div>
          </div>
        @endif

        @if (session('change_password_success'))
          <div class="container mt-2">
            <div class="alert alert-success">
              {{session('change_password_success')}}
            </div>
          </div>
        @endif
        <div class="panel-body">
          <form action="{{ url('/user/'.$auth->id.'/password/reset') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
            <label for="current" class="col-sm-3 control-label">現在のパスワード</label>
              <div class="col-sm-6 control-info">
              <input id="current" type="password" class="form-control" name="current-password" required autofocus>
              </div> 
            </div>
            @if($errors->has('current_password'))
              @foreach($errors->get('curent_password') as $message)
              <p class="error-message">{{ $message }}</p>
                @endforeach
              @endif 
            <div class="form-group">
            <label for="new-password" class="col-sm-3 control-label">新しいパスワード</label>
            <div class="col-sm-6 control-info">
            <input id="new-password" type="password" class="form-control" name="new-password" required>
                @if ($errors->has('new_password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('new_password') }}</strong>
                  </span>
                @endif
              </div> 
            </div>
            <div class="form-group">
            <label for="confirm" class="col-sm-3 control-label">新しいパスワード（確認用）</label>
              <div class="col-sm-6 control-info">
              <input id="confirm" type="password" class="form-control" name="new-password_confirmation" required>
              </div> 
            </div>
                <!-- Add Task Button -->
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-6">
                  <button type="submit" class="btn btn-default">
                    更新
                  </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endsection