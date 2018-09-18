@extends('layouts.default')

@section('content')
  <div class="page page-show page-member page-member-show">

    <div class="page-header">
      <div class="container">
        <div class="title">Overview the Member</div>
        <div class="block-breadcrumb">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('members.index') }}">Members</a></li>
            <li><a href="">Overview</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-6">
            <div class="form-view">
              <label>Name</label>
              <div>{{ $member->name }}</div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="form-view">
              <label>Email</label>
              <div>{{ $member->email }}</div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="form-view">
              <label>Team</label>
              <div>{{ $member->team->name }}</div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="form-view">
              <label>Status</label>
              <div>
                @if ($member->disabled === 0)
                  <span class="badge badge-success">actived</span>
                @else
                  <span class="badge badge-secondary">disabled</span>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="container">
        <div class="block-filter">
          <fieldset>
            <legend>Filter:</legend>
            <div class="row">
              <div class="col-xl-3">
                <div class="form-group">
                  <label>Choose a week:</label>
                  <select class="select-week">
                    <option value="none" selected>Show All</option>
                    @foreach ($weeks as $week)
                    <option value="{{ $week->id }}">{{ $week->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-xl-3">
                <div class="form-group">
                  <label>Choose a project:</label>
                  <select class="select-project">
                    <option value="none" selected>Show All</option>
                    @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="block-table block-table-tasks">
          <div class="block-header">
            <span class="block-title">
              Project
            </span>
            <span class="block-title">
              Week
            </span>
            <span class="block-title">
              Task
            </span>
            <span class="block-title flex-center">
              Value
            </span>
            <span class="block-title">
              Note
            </span>
          </div>
          <div class="block-content">
            @foreach ($member->tasks as $task)
            <div class="block-record project-{{ $task->project_id }} week-{{ $task->week_id }} task-{{ $task->id }}">
              <span class="block-cell">{{ $task->project->name }}</span>
              <span class="block-cell">{{ $task->week->name }}</span>
              <span class="block-cell">{{ $task->name }}</span>
              <span class="block-cell flex-center">{{ $task->value }}</span>
              <span class="block-cell">
                <a class="note-link" href="#" data-note="{{ $task->note }}">Note</a>
              </span>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('modals.note')

@endsection
