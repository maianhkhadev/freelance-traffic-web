@extends('layouts.blank')

@section('content')
  <div class="page page-projects-create">
    <div class="page-header">
      <h3 class="page-title">Create a Project</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">List of Projects</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/projects" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" placeholder="Ex: Omo" autocomplete="off" required>
        </div>

        <div class="form-group">
          <label>Color</label>
          <input type="color" name="color" class="form-control">
        </div>

        <a class="btn btn-secondary" href="{{ route('projects.index') }}">Cancel</a>
        <button class="btn btn-gold">Save & Close</button>
      </form>
    </div>
  </div>
@endsection
