@extends('layouts.default')

@section('stylesheet')
  <link href="{{ asset('css/pages.edit.css') }}" rel="stylesheet">
  <link href="{{ asset('css/tasks.create.css') }}" rel="stylesheet">
@endsection

@section('javascript')
  <script src="{{ asset('js/tasks.create.js') }}"></script>
@endsection

@section('content')
  <div class="page">
    <div class="page-header">
      <div class="col-xl-12">
        <div class="title">Create a new Task</div>
        <div class="breadcumb">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-6">
        <form action="/tasks" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label>Choose a Week</label>
            <select id="week_id" class="form-control">
              {{-- @foreach ($weeks as $week)
              <option value="{{ $week->id }}">{{ $week->name }}</option>
              @endforeach --}}
            </select>
          </div>
          <div class="form-group">
            <label>Choose a Project</label>
            <select name="project_id" class="form-control">
              @foreach ($projects as $project)
              <option value="{{ $project->id }}">{{ $project->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Name of Task</label>
            <input name="name" type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Who follow this Task?</label>
            <select name="member_id" class="form-control">
              @foreach ($members as $member)
              <option value="{{ $member->id }}">{{ $member->name }}</option>
              @endforeach
            </select>
            <small class="form-text text-muted">
              This member do <span class="value" v-text="tasks_create.value"></span> values this week.
            </small>
          </div>
          <div class="form-group">
            <label>Value</label>
            <input name="value" type="number" min="0" max="100" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Note</label>
            <textarea name="note" class="form-control" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-dark">Save & Close</button>
        </form>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Member's week tasks</label>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="50"></th>
                <th>Task name</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              <template v-for="(task, index) in tasks_create.tasks">
                <tr>
                  <td class="text-center" v-text="index + 1"></td>
                  <td v-text="task.name"></td>
                  <td class="text-center" v-text="task.value"></td>
                </tr>
              </template>
            </tbody>
            <thead>
              <tr>
                <th class="text-center" colspan="2">Total</th>
                <th class="text-center" v-text="tasks_create.value"></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
