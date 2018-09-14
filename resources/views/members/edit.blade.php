@extends('layouts.fullscreen')

@section('content')
  <div class="page page-edit page-member page-member-edit">

    <a class="btn btn-dark btn-close" href="{{ route('members.index') }}">&#10005;</a>

    <div class="page-header">
      <h4>Edit Member's info</h4>
      <div class="block-breadcrumb">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('members.index') }}">Members</a></li>
          <li><a href="">Edit</a></li>
        </ul>
      </div>
    </div>

    <div class="page-content">
      <form class="block-form" action="/members/{{ $member->id }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>What's your name?</label>
          <input name="name" type="text" class="form-control" placeholder="Enter name..." autocomplete="off" value="{{ $member->name }}">
        </div>

        <div class="form-group">
          <label>Could you send me your email?</label>
          <input name="email" type="text" class="form-control" placeholder="Enter email..." autocomplete="off" value="{{ $member->email }}">
        </div>

        <div class="form-group form-select">
          <label>Choose Your Team</label>
          <select name="team_id" class="">
            @foreach ($teams as $team)
            <option value="{{ $team->id }}" @if ($team->id === $member->team_id) {{ 'selected' }} @endif>{{ $team->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group form-color">
          <label>Pick a color for this member</label>
          <input name="color" type="color" class="form-control" autocomplete="off">
          <small class="text-muted">It's used to display on the graph</small>
        </div>

        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="checkbox-disabled" name="disabled" {{ $member->disabled === 1 ? 'checked' : '' }}>
          <label class="form-check-label" for="checkbox-disabled">Disable this member</label>
        </div>

        <button class="btn btn-dark">Save & Close</button>
      </div>
    </div>
  </div>
@endsection
