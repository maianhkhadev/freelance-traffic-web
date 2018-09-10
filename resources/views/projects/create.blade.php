@extends('layouts.fullscreen')

@section('content')
  <div class="page page-create page-project page-project-create">

    <a class="btn btn-dark btn-close" href="{{ route('projects.index') }}">&#10005;</a>

    <div class="page-header">
      <h4>Create a new Project</h4>
      <div class="block-breadcrumb">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('projects.index') }}">Projects</a></li>
          <li><a href="">Create</a></li>
        </ul>
      </div>
    </div>

    <div class="page-content">
      <form class="block-form" action="/projects" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>What's the name of project?</label>
          <input name="name" type="text" class="form-control" placeholder="Enter name..." autocomplete="off">
        </div>

        <button class="btn btn-dark">Save & Close</button>
      </form>
    </div>
  </div>
@endsection
