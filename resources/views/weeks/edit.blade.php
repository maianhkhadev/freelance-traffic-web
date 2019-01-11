@extends('layouts.blank')

@section('content')
  <div class="page page-projects-create">
    <div class="page-header">
      <h3 class="page-title">Create a Week</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('weeks.index') }}">List of Week</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/weeks/{{ $week->id }}" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="{{ $week->name }}" placeholder="Ex: Week 10 - 2018" autocomplete="off" required>
        </div>

        <div class="form-group">
          <label>Start date</label>
          <flatpickr name="start_date" default-date="{{ $week->start_date }}"></flatpickr>
          <small class="form-text text-muted">Help us to sort data.</small>
        </div>

        <div class="form-group custom-control custom-checkbox">
          <input type="checkbox" id="checkbox-closed" name="closed" class="custom-control-input" {{ $week->closed === 0 ? '' : 'checked' }}>
          <label class="custom-control-label" for="checkbox-closed">Close this week?</label>
        </div>

        <div class="form-footer">
          <a class="btn btn-secondary" href="{{ route('weeks.index') }}">Cancel</a>
          <button class="btn btn-gold">Save & Close</button>
        </div>
      </form>
    </div>
  </div>
@endsection
