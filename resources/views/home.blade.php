@extends('layouts.default')

@section('stylesheet')
  <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="page">
    <div class="page-content">
      <div class="col-xl-12">
        <div class="title">Quick Cast</div>
      </div>
      <div class="col-xl-3">
        <div class="block block-yellow">
          <div class="block-content">
            <img width="75" src="/images/im-01.png" alt=""/>
          </div>
          <div class="block-footer">
            <a href="/weeks/{{ $week->id }}">Latest Week</a>
          </div>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="block block-teal">
          <div class="block-content">
            <img width="75" src="/images/im-02.png" alt=""/>
          </div>
          <div class="block-footer">
            <a href="{{ route('tasks.create') }}">New Task</a>
          </div>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-12">
        <div class="title">Management</div>
      </div>
      <div class="col-xl-3">
        <div class="block block-brown">
          <div class="block-content">
            <img width="75" src="/images/projects.png" alt=""/>
          </div>
          <div class="block-footer">
            <a href="{{ route('projects.index') }}">Projects</a>
          </div>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="block block-state">
          <div class="block-content">
            <img width="75" src="/images/weeks.png" alt=""/>
          </div>
          <div class="block-footer">
            <a href="{{ route('weeks.index') }}">Weeks</a>
          </div>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="block block-red">
          <div class="block-content">
            <img width="75" src="/images/members.png" alt=""/>
          </div>
          <div class="block-footer">
            <a href="{{ route('members.index') }}">Members</a>
          </div>
        </div>
      </div>
    </div>
    {{-- <div class="page-content">
      <div class="col-xl-12">
        <div class="title">Lastest Week</div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Members</label>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($members as $member)
              <tr>
                <td>{{ $member->name }}</td>
                <td class="text-center">{{ $member->value }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Projects</label>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($projects as $project)
              <tr>
                <td>{{ $project->name }}</td>
                <td class="text-center">{{ $project->value }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
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
      </div>
    </div> --}}
  </div>
@endsection
