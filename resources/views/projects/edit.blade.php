@extends('layouts.blank')

@section('content')
  <div class="page page-projects-edit">
    <div class="page-header">
      <h3 class="page-title">Edit a Project</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">List of Projects</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/projects/{{ $project->id }}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{ $project->name }}" placeholder="Ex: Omo" autocomplete="off" required>
        </div>

        <div class="form-group">
          <label>Color</label>
          <input type="color" name="color" class="form-control" value="{{ $project->color }}">
        </div>

        <div class="form-group custom-control custom-checkbox">
          <input type="checkbox" id="checkbox-closed" name="closed" class="custom-control-input" {{ $project->closed === 0 ? '' : 'checked' }}>
          <label class="custom-control-label" for="checkbox-closed">Close this project?</label>
        </div>

        <a class="btn btn-secondary" href="{{ route('projects.index') }}">Cancel</a>
        <button class="btn btn-gold">Save & Close</button>
      </form>
    </div>
  </div>
@endsection
