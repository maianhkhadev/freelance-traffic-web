@extends('layouts.blank')

@section('content')
  <div class="page page-members-edit">
    <div class="page-header">
      <h3 class="page-title">Edit a Member</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('members.index') }}">List of Members</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/members/{{ $member->id }}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Team</label>
          <select name="team_id" class="form-control">
            @foreach ($teams as $team)
            <option value="{{ $team->id }}" {{ $member->team_id === $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{ $member->name }}" placeholder="Ex: Mai Anh Kha" autocomplete="off" required>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="{{ $member->email }}" placeholder="Ex: maianhkha.dev@gmail.com" autocomplete="off" required>
        </div>

        <div class="form-group custom-control custom-checkbox">
          <input type="checkbox" id="checkbox-disabled" name="closed" class="custom-control-input" {{ $member->disabled === 0 ? '' : 'checked' }}>
          <label class="custom-control-label" for="checkbox-disabled">Disable this member?</label>
        </div>

        <div class="form-footer">
          <a class="btn btn-secondary" href="{{ route('members.index') }}">Cancel</a>
          <button class="btn btn-gold">Save & Close</button>
        </div>
      </form>
    </div>
  </div>
@endsection
