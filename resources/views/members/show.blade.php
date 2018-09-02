@extends('layouts.default')

@section('content')
  <div class="page page-show">
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
        <div class="form-view">
          <label>Tasks of the Week that you choose</label>

          {{-- <table class="table table-bordered">
            <thead>
              <tr>
                <th width="50"></th>
                <th>Name</th>
                <th>Project</th>
                <th>Week</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tasks as $task)
              <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->project->name }}</td>
                <td>{{ $task->week->name }}</td>
                <td class="text-center">{{ $task->value }}</td>
              </tr>
              @endforeach
            </tbody>
          </table> --}}
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
