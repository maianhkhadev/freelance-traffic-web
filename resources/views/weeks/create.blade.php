@extends('layouts.fullscreen')

@section('content')
  <div class="page page-create page-week page-week-create">

    <a class="btn btn-dark btn-close" href="{{ route('weeks.index') }}">&#10005;</a>

    <div class="page-header">
      <h4>Create a new Week</h4>
      <div class="block-breadcrumb">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('weeks.index') }}">Weeks</a></li>
          <li><a href="">Create</a></li>
        </ul>
      </div>
    </div>
    <div class="page-content">
      <form class="block-form" action="/weeks" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Name of Week</label>
          <input name="name" type="text" class="form-control" placeholder="Enter name..." autocomplete="off">
        </div>

        <div class="form-group">
          <label>From { Date } to { Date }</label>
          <input name="range" type="text" class="form-control" placeholder="Enter name..." autocomplete="off">
        </div>

        <button class="btn btn-dark">Save & Close</button>
      </div>
    </div>
  </div>
@endsection
