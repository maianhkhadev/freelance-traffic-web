@extends('layouts.blank')

@section('content')
  <div class="page page-tasks-create">
    <div class="page-header">
      <h3 class="page-title">Edit a Task</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">List of Tasks</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/tasks/{{ $task->id }}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Project</label>
          <select name="project_id" class="form-control">
            @foreach ($projects as $project)
            <option value="{{ $project->id }}" {{ $task->project_id === $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Week</label>
          <select name="week_id" class="form-control">
            @foreach ($weeks as $week)
            <option value="{{ $week->id }}" {{ $task->week_id === $week->id ? 'selected' : '' }}>{{ $week->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Member</label>
          <select name="member_id" class="form-control">
            @foreach ($members as $member)
            <option value="{{ $member->id }}" {{ $task->member_id === $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Name of Task</label>
          <input type="text" name="name" class="form-control" value="{{ $task->name }}" placeholder="Ex: Meeting" autocomplete="off">
        </div>

        <div class="form-group">
          <label>Value</label>
          <input type="number" name="value" class="form-control" value="{{ $task->value }}" placeholder="Ex: 50" autocomplete="off">
        </div>

        <div class="form-group">
          <label>Comment</label>
          <textarea type="text" name="comment" class="form-control" value="{{ $task->note }}" rows="2"></textarea>
        </div>

        <a class="btn btn-secondary" href="{{ route('tasks.index') }}">Cancel</a>
        <button class="btn btn-gold">Save & Close</button>
      </form>
    </div>
  </div>
@endsection
