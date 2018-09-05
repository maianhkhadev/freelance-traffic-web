@extends('layouts.default')

@section('content')
  <div class="page page-show">
    <div class="page-header">
      <div class="col-xl-12">
        <div class="title">Overview Week {{ $week->name }}</div>
        <div class="breadcumb">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('weeks.index') }}">Weeks</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-6">
        <div class="form-group">
          <label>Name</label>
          <div>{{ $week->name }}</div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Data</label>
          <div><b>{{ count($projects) }}</b> Projects - <b>{{ count($week->tasks) }}</b> Tasks - <b>{{ count($members) }}</b> Members</div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Status</label>
          <div>
            @if ($week->closed === 0)
              <span class="badge badge-success">opened</span>
            @else
              <span class="badge badge-secondary">closed</span>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="form-group">
              <label class="mb-0">Members</label>
              <small class="form-text text-muted">Select maximum 5 members.</small>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="teams">
              @foreach ($teams as $team)
                <div class="form-check team">
                  <input class="form-check-input" type="checkbox" data-team-id="{{ $team->id }}" value="{{ $team->id }}" id="select-team-{{ $team->id }}" checked>
                  <label class="form-check-label" for="select-team-{{ $team->id }}">
                    {{ $team->name }} Team
                  </label>
                </div>
                <div class="members">
                @foreach ($members as $member)
                  @if ($member->team_id === $team->id)
                  <div class="form-check team-{{ $team->id }} member">
                    <input class="form-check-input" type="checkbox" data-team-id="{{ $team->id }}" value="{{ $member->id }}" id="select-member-{{ $member->id }}" checked>
                    <label class="form-check-label" for="select-member-{{ $member->id }}">
                      {{ $member->name }}
                    </label>
                  </div>
                  @endif
                @endforeach
                </div>
              @endforeach
            </div>
          </div>
          <div class="col-xl-8">
            <div class="chart-container">
              <canvas id="chart-members"></canvas>
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
              <label class="mb-0">Projects</label>
              <small class="form-text text-muted">Select maximum 5 projects.</small>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="projects">
              @foreach ($projects as $project)
              <div class="form-check project">
                <input class="form-check-input" type="checkbox" value="{{ $project->id }}" id="select-project-{{ $project->id }}" checked>
                <label class="form-check-label" for="select-project-{{ $project->id }}">
                  {{ $project->name }}
                </label>
              </div>
              @endforeach
            </div>
          </div>
          <div class="col-xl-8">
            <div class="chart-container">
              <canvas id="chart-projects"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-12">
        <div class="form-group">
          <label>Tasks</label>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="50"></th>
                <th>Name</th>
                <th>Project</th>
                <th>Member</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($week->tasks as $task)
              <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->project->name }}</td>
                <td>{{ $task->member->name }}</td>
                <td class="text-center">{{ $task->value }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <a class="btn btn-dark" href="{{ route('tasks.create') }}">New Task in this Week</a>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script>
    window.tasks = []
    @foreach ($week->tasks as $task)
      window.tasks.push({
        id: {{ $task->id }},
        name: '{{ $task->name }}',
        value: {{ $task->value }},
        memberId: {{ $task->member->id }},
        memberName: '{{ $task->member->name }}',
        projectId: {{ $task->project->id }},
        projectName: '{{ $task->project->name }}',
      })
    @endforeach

    let colors = [
      'rgb(255, 102, 102)',
      'rgb(255, 179, 102)',
      'rgb(255, 255, 102)',
      'rgb(179, 255, 102)',
      'rgb(140, 255, 102)',
      'rgb(102, 255, 102)',
      'rgb(102, 255, 179)',
      'rgb(102, 255, 255)',
      'rgb(102, 179, 255)',
      'rgb(102, 102, 255)',
      'rgb(153, 102, 255)',
      'rgb(217, 102, 255)',
      'rgb(255, 102, 217)',
      'rgb(255, 102, 140)',
      'rgb(255, 140, 102)',
      'rgb(255, 217, 102)',
      'rgb(217, 255, 102)',
      'rgb(140, 255, 102)',
      'rgb(102, 255, 140)',
      'rgb(102, 255, 217)',
      'rgb(102, 217, 255)',
      'rgb(255, 140, 102)',
      'rgb(255, 217, 102)',
      'rgb(102, 140, 255)',
      'rgb(140, 102, 255)',
      'rgb(179, 102, 255)',
      'rgb(255, 102, 255)',
      'rgb(255, 102, 179)',
      'rgb(255, 102, 102)'
    ]

    window.projects = []
    @foreach ($projects as $project)
      window.projects.push({
        id: {{ $project->id }},
        name: '{{ $project->name }}',
        color: colors[{{ $project->id }}]
      })
    @endforeach

    window.members = []
    @foreach ($members as $member)
      window.members.push({
        id: {{ $member->id }},
        name: '{{ $member->name }}',
        color: colors[{{ $member->id }}]
      })
    @endforeach
  </script>
@endsection
