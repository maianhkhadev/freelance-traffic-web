@extends('layouts.default')

@section('content')
  <div class="page">
    <div class="page-header">
      <div class="row">
        <div class="col-xl-6">
          <h3 class="page-title">List of Tasks</h3>

          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List of Tasks</li>
          </ol>
        </div>
        <div class="col-xl-6">
          <div class="tool-box">
            <field-search></field-search>
            <a class="btn btn-gold btn-create" href="{{ route('tasks.create') }}">Create</a>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="table table-tasks">
        <div class="table-header">
          <span class="table-column-title">
            #
          </span>
          <span class="table-column-title">
            Name of Task
          </span>
          <span class="table-column-title">
            Member
          </span>
          <span class="table-column-title">
            Value
          </span>
          <span class="table-column-title">
            Update At
          </span>
          <span class="table-column-title">
            Actions
          </span>
        </div>
        <div class="table-content">
          @foreach ($tasks as $task)
            <div class="table-row">
              <span class="table-cell">{{ $tasks->firstItem() + $loop->index }}</span>
              <span class="table-cell">{{ $task->name }}</span>
              <span class="table-cell">{{ $task->member->name }}</span>
              <span class="table-cell">{{ $task->value }}</span>
              <span class="table-cell">
                <time datetime="{{ $task->updated_at }}">{{ $task->updated_at->format('Y-m-d H:i') }}</time>
              </span>
              <span class="table-cell">
                <a class="" href="#" data-project-name="{{ $task->project->name }}" data-week-name="{{ $task->week->name }}" data-member-name="{{ $task->member->name }}" onclick="showDetail({{ $task }}, event)">Detail</a>
                <a class="" href="{{ route('tasks.edit', ['id' => $task->id]) }}">Edit</a>
              </span>
            </div>
          @endforeach
        </div>
        <div class="table-footer">
          Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} entries

          {{ $tasks->links('vendor.pagination.default') }}
        </div>
      </div>
    </div>

    <modal-task-detail ref="modal-detail"></modal-task-detail>
  </div>
@endsection
