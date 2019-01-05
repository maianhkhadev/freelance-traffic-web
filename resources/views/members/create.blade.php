@extends('layouts.blank')

@section('content')
  <div class="page page-members-create">
    <div class="page-header">
      <h3 class="page-title">Create a Member</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('members.index') }}">List of Members</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/members" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Team</label>
          <select name="team_id" class="form-control">
            @foreach ($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" placeholder="Ex: Mai Anh Kha" autocomplete="off">
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="Ex: maianhkha.dev@gmail.com" autocomplete="off">
        </div>

        <a class="btn btn-secondary" href="{{ route('members.index') }}">Cancel</a>
        <button class="btn btn-gold">Save & Close</button>
      </form>
    </div>
  </div>
@endsection
