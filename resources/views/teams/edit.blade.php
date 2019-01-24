@extends('layouts.blank')

@section('content')
  <div class="page page-teams-edit">
    <div class="page-header">
      <h3 class="page-title">Edit a Team</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">List of Teams</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/teams/{{ $team->id }}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{ $team->name }}" placeholder="Ex: Admin" autocomplete="off" required>
        </div>

        <div class="form-group">
          <label>Color</label>
          <input type="color" name="color" class="form-control" value="{{ $team->color }}">
        </div>

        <div class="form-footer">
          <a class="btn btn-secondary" href="{{ route('teams.index') }}">Cancel</a>
          <button class="btn btn-gold">Save & Close</button>
        </div>
      </form>
    </div>
  </div>
@endsection
