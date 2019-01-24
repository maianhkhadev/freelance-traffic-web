@extends('layouts.default')

@section('content')
  <div class="page page-show page-weeks-show">
    <div class="page-header">
      <h3 class="page-title">View a Week</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('weeks.index') }}">List of Weeks</a></li>
        <li class="breadcrumb-item active" aria-current="page">View</li>
      </ol>
    </div>

    <div class="page-content">
      <div class="row">
        <div class="col-xl-6">
          <div class="form-group">
            <label class="form-control-label">Name</label>
            <input type="text" class="form-control-plaintext" value="{{ $week->name }}">
          </div>
          <div class="form-group">
            <label class="form-control-label">Start date</label>
            <input type="text" class="form-control-plaintext" value="{{ $week->start_date }}">
          </div>
          <div class="form-group">
            <label class="form-control-label">End date</label>
            <input type="text" class="form-control-plaintext" value="{{ $week->end_date }}">
          </div>
        </div>
        <div class="col-xl-6">
          <div class="form-group">
            <label class="form-control-label">Status</label>
            <status-closed :status="{{ $week->closed }}"></status-closed>
          </div>
        </div>
      </div>

      <charts-of-week :week="{{ $week }}"></charts-of-week>
    </div>
  </div>
@endsection
