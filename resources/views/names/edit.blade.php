@extends('layouts.fullscreen')

@section('content')
  <div class="page page-create page-edit page-name-edit">

    <a class="btn btn-dark btn-close" href="{{ route('names.index') }}">&#10005;</a>

    <div class="page-header">
      <h4>Edit Name</h4>
      <div class="block-breadcrumb">
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('names.index') }}">Names Of Task</a></li>
          <li><a href="">Edit</a></li>
        </ul>
      </div>
    </div>

    <div class="page-content">
      <form class="block-form" action="/names/{{ $name->id }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Name Of Task</label>
          <input name="value" type="text" class="form-control" placeholder="Enter name..." value="{{ $name->value }}" autocomplete="off">
        </div>

        <button class="btn btn-dark">Save & Close</button>
      </form>
    </div>
  </div>
@endsection
