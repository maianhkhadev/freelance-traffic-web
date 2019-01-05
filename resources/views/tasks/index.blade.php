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
            <div class="field-search">
              <img class="icon" src="/images/icon-search.png" alt="" />
              <input type="text" class="form-control" placeholder="Type to search..."/>
            </div>
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
            Project
          </span>
          <span class="table-column-title">
            Week
          </span>
          <span class="table-column-title">
            Value
          </span>
          <span class="table-column-title">
            Status
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
              <span class="table-cell">{{ $task->project->name }}</span>
              <span class="table-cell">{{ $task->week->name }}</span>
              <span class="table-cell">{{ $task->value }}</span>
              <span class="table-cell">closed</span>
              <span class="table-cell">
                <time datetime="{{ $task->updated_at }}">{{ $task->updated_at->format('Y-m-d H:i') }}</time>
              </span>
              <span class="table-cell">
                <a class="" data-note="{{ $task->note }}" onclick="showNote">Note</a>
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

    <div ref="modal" class="modal modal-note fade" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Note</h5>
          </div>
          <div class="modal-body">
            <p>dadasdas</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
