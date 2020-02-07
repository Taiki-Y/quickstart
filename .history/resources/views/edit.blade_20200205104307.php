@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-8">
      <div class="panel panel-default">
        <div class="panel-heading">
        Edit Task
        </div>
        <div class="panel-body">
          <!-- Display Validation Errors -->
          @include('common.errors')
          <!-- Edit Task Form -->
          <form action="{{ url('task/'.$task->id) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT')}}
            <!-- Task Name  -->
            <div class="form-group">
            <label for="task-name" class="col-sm-3 control-label">Task</label>
                  <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}" />
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
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Task
                  </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
    @endsection