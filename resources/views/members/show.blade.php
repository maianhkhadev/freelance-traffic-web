@extends('layouts.default')

@section('content')
  <div class="page page-member page-show">
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
              <a href="{{ route('teams.show', ['id' => $member->team->id]) }}">{{ $member->team->name }}</a>
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
        <div class="row">
          <div class="col-xl-4">
            <div class="form-view">
              <label>Choose a Week</label>
              {{-- <select name="week_id" class="form-control" value="{{ $week->id }}">
                @foreach ($weeks as $week)
                <option value="{{ $week->id }}">{{ $week->name }}</option>
                @endforeach
              </select> --}}
            </div>
            <div class="form-group">
              {{-- <div class="mb-3">- <b>{{ count($projects) }}</b> Projects</div>
              <div class="mb-3">- <b>{{ count($tasks) }}</b> Tasks</div> --}}
              {{-- <div class="mb-3">- <b>{{ $latest_week_value }}</b> Values</div> --}}
            </div>
          </div>
          <div class="col-xl-8">
            <div class="chart-container">
              <canvas id="chart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="container">
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
            <div class="block-record task-{{ $task->id }}">
              <span class="block-cell">{{ $task->project->name }}</span>
              <span class="block-cell">{{ $task->week->name }}</span>
              <span class="block-cell">{{ $task->name }}</span>
              <span class="block-cell flex-center">{{ $task->value }}</span>
              <span class="block-cell">Note</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script>
    window.memberId = {{ $member->id }}
    window.tasks = []
    @foreach ($member->tasks as $task)
      window.tasks.push({
        id: {{ $task->id }},
        name: '{{ $task->name }}',
        value: {{ $task->value }},
        weekId: {{ $task->week->id }},
        weekName: '{{ $task->week->name }}',
        projectId: {{ $task->project->id }},
        projectName: '{{ $task->project->name }}',
      })
    @endforeach
  </script>
@endsection
