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
              <label for="task-name" class="col-sm-3 control-label">タスク内容</label>
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
              <label for="due" class="col-sm-3 control-label">期限</label>
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
         
          @endif
        </div>
      </div>
    @endsection