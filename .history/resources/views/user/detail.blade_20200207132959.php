@extends('layouts.app')
@section('content')
  <div class="panel-heading">
    {{$user->name}}
  </div>
  <div class="form-group">
    <label for="due" class="col-sm-3 control-label">期限</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="due" id="due" value="{{ old('due') }}" />
    </div> 
  </div>
@endsection