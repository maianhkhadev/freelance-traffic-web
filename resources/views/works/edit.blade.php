@extends('layouts.blank')

@section('content')
  <div class="page page-works-edit">
    <div class="page-header">
      <h3 class="page-title">Edit a Work</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('works.index') }}">List of Works</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/works/{{ $work->id }}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Parent</label>
          <select name="parent_id" class="form-control" tabindex="1">
              <option hidden selected value>Select...</option>
            @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" {{ $work->parent_id === $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{ $work->name }}" placeholder="Ex: Create Website" autocomplete="off" required>
        </div>

        <div class="form-footer">
          <a class="btn btn-secondary" href="{{ route('works.index') }}">Cancel</a>
          <button class="btn btn-gold">Save & Close</button>
        </div>
      </form>
    </div>
  </div>
@endsection
