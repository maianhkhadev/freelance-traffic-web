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
            <input type="email" class="form-control-plaintext" value="{{ $week->name }}">
          </div>
        </div>
        <div class="col-xl-6">
          <div class="form-group">
            <label class="form-control-label">Status</label>
            <input type="email" class="form-control-plaintext" value="{{ $week->closed }}">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="form-control-label">Members</label>
        <chart-week :week="{{ $week }}"></chart-week>
      </div>
    </div>
  </div>
@endsection
