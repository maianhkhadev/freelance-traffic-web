@extends('layouts.default')

@section('content')
  <div class="page">
    <div class="page-header">
      <h3 class="page-title">Home</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      </ol>
    </div>

    <div class="page-content">
      <h4>Tutorial</h4>
      <ol>
        <li>Create a team</li>
        <li>Create a member</li>
        <li>Create a project</li>
        <li>Create a week</li>
        <li>Create a task</li>
      </ol>
    </div>

    @if ($week !== NULL)
    <div class="page-content">
      <h4>Latest week: {{ $week->name }}</h4>

      <div class="row">
        <div class="col-xl-6">
          <div class="form-group">
            <label class="form-control-label">Projects</label>
            <chart-pie-projects :week="{{ $week }}"></chart-pie-projects>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="form-group">
            <label class="form-control-label">Teams</label>
            <chart-pie-teams :week="{{ $week }}"></chart-pie-teams>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="form-control-label">Members</label>
        <chart-bar-members :week="{{ $week }}"></chart-bar-members>
      </div>
    </div>
    @endif
  </div>
@endsection
