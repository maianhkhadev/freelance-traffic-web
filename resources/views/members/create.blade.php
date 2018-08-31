@extends('layouts.fullscreen')

@section('content')
  <div class="page page-create">

    <a class="btn btn-dark btn-close" href="{{ route('members.index') }}">&#10005;</a>

    <div class="page-header">
      <h4>Create a new Member</h4>
    </div>

    <div class="page-content">
      <form class="block-form" action="/members" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="disabled" value="on">

        <div class="form-group">
          <label>What's your name?</label>
          <input name="name" type="text" class="form-control" placeholder="Enter name" autocomplete="off">
        </div>
        <div class="form-group">
          <label>Could you send me your email address?</label>
          <input name="email" type="text" class="form-control" placeholder="Enter email" autocomplete="off">
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

@section('javascript')
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      $('select').selectize();

      let rules = [
        {
          require: {
            names: [
              'name',
              'email'
            ]
          }
        }
      ]

      let validation = window.Validation('.page-create form', rules)
    })
  </script>
@endsection
