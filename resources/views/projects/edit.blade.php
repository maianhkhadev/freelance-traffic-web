@extends('layouts.fullscreen')

@section('content')
  <div class="page page-edit page-project page-project-edit">

    <a class="btn btn-dark btn-close" href="{{ route('projects.index') }}">&#10005;</a>

    <div class="page-header">
      <h4>Edit Project's info</h4>
      <div class="block-breadcrumb">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('projects.index') }}">Projects</a></li>
          <li><a href="">Edit</a></li>
        </ul>
      </div>
    </div>

    <div class="page-content">
      <form class="block-form" action="/projects/{{ $project->id }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <span class="avatar-name">HL</span>
        
        <div class="form-group">
          <label>What's the name of project?</label>
          <input name="name" type="text" class="form-control" placeholder="Enter name..." value="{{ $project->name }}" autocomplete="off">
        </div>

        <div class="form-group form-color">
          <label>Pick a color for this project</label>
          <input name="color" type="color" class="form-control" value="{{ $project->color }}" autocomplete="off">
          <small class="text-muted">It's used to display on the graph</small>
        </div>

        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="checkbox-closed" name="closed" {{ $project->closed === 1 ? 'checked' : '' }}>
          <label class="form-check-label" for="checkbox-closed">Close this project</label>
        </div>

        <button class="btn btn-dark">Save & Close</button>
      </form>
    </div>
  </div>
@endsection
