@extends('layouts.default')

@section('content')
  <div class="page page-edit page-week page-week-edit">

    <a class="btn btn-dark btn-close" href="{{ route('weeks.index') }}">&#10005;</a>

    <div class="page-header">
      <h4>Edit Week's info</h4>
      <div class="block-breadcrumb">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('weeks.index') }}">Weeks</a></li>
          <li><a href="">Edit</a></li>
        </ul>
      </div>
    </div>

    <div class="page-content">
      <form class="block-form" action="/weeks/{{ $week->id }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Name of Week</label>
          <input name="name" type="text" class="form-control" placeholder="Enter name..." value="{{ $week->name }}" autocomplete="off">
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="checkbox-closed" name="closed" {{ $week->closed === 1 ? 'checked' : '' }}>
          <label class="form-check-label" for="checkbox-closed">Close this week</label>
        </div>

        <button class="btn btn-dark">Save & Close</button>
      </form>
    </div>
  </div>
@endsection
