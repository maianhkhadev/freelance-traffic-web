@extends('layouts.default')

@section('content')
  <div class="page page-show page-project page-project-show">

    <div class="page-header">
      <div class="container">
        <div class="title">Overview Project {{ $project->name }}</div>
        <div class="block-breadcrumb">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
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
              <div>{{ $project->name }}</div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="form-view">
              <label>Data</label>
              <div><b>{{ count($weeks) }}</b> Weeks - <b>{{ count($project->tasks) }}</b> Tasks - <b>{{ count($members) }}</b> Members</div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="form-view">
              <label>Status</label>
              <div>
                @if ($project->closed === 0)
                  <span class="badge badge-success">opened</span>
                @else
                  <span class="badge badge-secondary">closed</span>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="form-group">
              <label>Process</label>
              <div class="chart-container">
                <canvas id="chart"></canvas>
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
                  <label>Choose a member:</label>
                  <select class="select-member">
                    <option value="none" selected>Show All</option>
                    @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
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
              Week
            </span>
            <span class="block-title">
              Task
            </span>
            <span class="block-title">
              Member
            </span>
            <span class="block-title flex-center">
              Value
            </span>
            <span class="block-title">
              Note
            </span>
          </div>
          <div class="block-content">
            @foreach ($project->tasks as $task)
            <div class="block-record member-{{ $task->member_id }} week-{{ $task->week_id }} task-{{ $task->id }}">
              <span class="block-cell">{{ $task->week->name }}</span>
              <span class="block-cell">{{ $task->name }}</span>
              <span class="block-cell">{{ $task->member->name }}</span>
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

@section('javascript')
  <script>
    window.projectColor = '{{ $project->color }}'

    window.weeks = []
    @foreach ($weeks as $week)
      window.weeks.push({
        id: {{ $week->id }},
        name: '{{ $week->name }}',
        value: {{ $week->value }}
      })
    @endforeach
  </script>
@endsection
