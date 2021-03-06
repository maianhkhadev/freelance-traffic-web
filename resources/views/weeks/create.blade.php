@extends('layouts.blank')

@section('content')
  <div class="page page-weeks-create">
    <div class="page-header">
      <h3 class="page-title">Create a Week</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('weeks.index') }}">List of Weeks</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/weeks" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" placeholder="Ex: Week 10 - 2018" autocomplete="off" required>
        </div>

        <div class="form-group">
          <label>Start date</label>
          <flatpickr name="start_date"></flatpickr>
          <small class="form-text text-muted">Help us to sort data.</small>
        </div>

        <div class="form-footer">
          <a class="btn btn-secondary" href="{{ route('weeks.index') }}">Cancel</a>
          <button class="btn btn-gold">Save & Close</button>
        </div>
      </form>
    </div>
  </div>
@endsection
