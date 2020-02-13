@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-12" style="margin: 0 20px">
      <div class="panel panel-default">
        <div class="panel-heading">
        {{$auth->name}}
        </div>
        <div class="panel-body">
          <form action="{{ url('/user/'.$auth->id.'/mailaddress/preupdate') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- メールアドレス -->
            <div class="form-group">
            <label for="email" class="col-sm-3 control-label">新しいメールアドレス</label>
              <div class="col-sm-6 control-info">
                <input type="text" name="new_email" id="email" class="form-control" value="{{ $auth->email }}">
              </div> 
            </div>
            @if($errors->has('email'))
              @foreach($errors->get('email') as $message)
              <p class="error-message">{{ $message }}</p>
                @endforeach
              @endif 
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