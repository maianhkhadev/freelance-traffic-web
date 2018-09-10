@extends('layouts.fullscreen')

@section('content')
  <div class="page page-create page-member page-member-create">

    <a class="btn btn-dark btn-close" href="{{ route('members.index') }}">&#10005;</a>

    <div class="page-header">
      <h4>Create a new Member</h4>
      <div class="block-breadcrumb">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('members.index') }}">Members</a></li>
          <li><a href="">Create</a></li>
        </ul>
      </div>
    </div>

    <div class="page-content">
      <form class="block-form" action="/members" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>What's your name?</label>
          <input name="name" type="text" class="form-control" placeholder="Enter name..." autocomplete="off">
        </div>
        <div class="form-group">
          <label>Could you send me your email?</label>
          <input name="email" type="text" class="form-control" placeholder="Enter email..." autocomplete="off">
        </div>
        <div class="form-group form-select">
          <label>Choose Your Team</label>
          <select name="team_id" class="">
            @foreach ($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
          </select>
        </div>

        <button class="btn btn-dark">Save & Close</button>
      </form>
    </div>
  </div>
@endsection
