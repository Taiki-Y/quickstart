@extends('layouts.app')
@section('content')

<div class="panel-body">
  <table class="table table-striped task-table">
  <h4>"{{$keyword}}"を含むタスク</h4>
  <!-- テーブルヘッダ --> 
    <thead>
      <th>ユーザー名</th>
      <th>タスク名</th>
      <th>期限</th>
      <th>ステータス</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </thead>
    <!-- テーブル本体 --> 
    <tbody>
      @foreach ($hittasks as $task)
        <tr>
      <!-- 投稿者名 -->
      <td class="table-text">
        <div>{{ $task->user->name }}</div>
      </td>
      <!-- タスク名 -->
      <td class="table-text">
        <div>{{ $task->name }}</div>
      </td>
      <!-- 期限 -->
      <td class="table-text">
        <div>{{ $task->due }}</div>
      </td>
      <!-- 状態 -->
      <td class="table-text">
        <div>{{ $task->status }}</div>
      </td>
      <td>
        @if(Auth::id() === $task->user_id)
      <!-- TODO: 削除ボタン -->
      <form action="{{ url('task/'.$task->id) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button type="submit" class="btn btn-danger" onClick="delete_alert(event);return false;">
            <i class="fa fa-trash"></i> 削除
          </button>
        </form>
      </td>
      <td>
      <form action="{{ url('task/'.$task->id.'/edit') }}" method="GET">
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 編集
          </button>
        </form>
      </td>
      </td>
      @else
      <td>
      @endif
      </td> 
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="d-flex justify-content-center text-center">
          {{ $hittasks->appends(request()->input())->links() }}
        </div>
@endsection