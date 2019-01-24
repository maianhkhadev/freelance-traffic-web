@extends('layouts.blank')

@section('content')
  <div class="page page-tasks-create">
    <div class="page-header">
      <h3 class="page-title">Create a Task</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">List of Tasks</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/tasks" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label>Project</label>
            <select name="project_id" class="form-control" tabindex="1">
              @foreach ($projects as $project)
              <option value="{{ $project->id }}">{{ $project->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Week</label>
            <select name="week_id" class="form-control" tabindex="2">
              @foreach ($weeks as $week)
              <option value="{{ $week->id }}" {{ $week->start_date < $date && $date < $week->end_date ? 'selected' : '' }}>{{ $week->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Member</label>
            <select name="member_id" class="form-control" tabindex="3">
              @foreach ($members as $member)
              <option value="{{ $member->id }}">{{ $member->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Name of Task</label>
            <select-works name="name" tabindex="4" :onchange="test"></select-works>
          </div>

          <div class="form-group">
            <label>Time Estimate (hour)</label>
            <input type="number" name="value" class="form-control" placeholder="Ex: 8" autocomplete="off" tabindex="5" required>
          </div>

          <div class="form-group">
            <label>Comment</label>
            <textarea type="text" name="comment" class="form-control" rows="2" tabindex="6"></textarea>
          </div>

          <div class="form-footer">
            <a class="btn btn-secondary" href="{{ route('tasks.index') }}">Cancel</a>
            <button class="btn btn-gold">Save & Close</button>
          </div>
        </div>
      </form>
    </div>

    <table-tasks-01 ref="float" />
  </div>
@endsection
