@extends('layouts.default')

@section('content')
  <div class="page page-show page-projects-show">
    <div class="page-header">
      <h3 class="page-title">View a Project</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">List of Projects</a></li>
        <li class="breadcrumb-item active" aria-current="page">View</li>
      </ol>
    </div>

    <div class="page-content">
      <div class="row">
        <div class="col-xl-6">
          <div class="form-group">
            <label class="form-control-label">Name</label>
            <input type="text" class="form-control-plaintext" value="{{ $project->name }}">
          </div>
        </div>
        <div class="col-xl-6">
          <div class="form-group">
            <label class="form-control-label">Status</label>
            <status-closed :status="{{ $project->closed }}"></status-closed>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="form-control-label">Timeline</label>
        <chart-timeline :project="{{ $project }}"></chart-timeline>
      </div>
    </div>
  </div>
@endsection
