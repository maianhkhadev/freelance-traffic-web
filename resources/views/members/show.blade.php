@extends('layouts.default')

@section('content')
  <div class="page page-show page-members-show">
    <div class="page-header">
      <h3 class="page-title">View a Member</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('members.index') }}">List of Members</a></li>
        <li class="breadcrumb-item active" aria-current="page">View</li>
      </ol>
    </div>

    <div class="page-content">
      <div class="row">
        <div class="col-xl-6">
          <div class="form-group">
            <label class="form-control-label">Name</label>
            <input type="email" class="form-control-plaintext" value="{{ $member->name }}">
          </div>
          <div class="form-group">
            <label class="form-control-label">Email</label>
            <input type="email" class="form-control-plaintext" value="{{ $member->email }}">
          </div>
          <div class="form-group">
            <label class="form-control-label">Team</label>
            <input type="email" class="form-control-plaintext" value="{{ $member->team->name }}">
          </div>
        </div>
        <div class="col-xl-6">
          <div class="form-group">
            <label class="form-control-label">Status</label>
            <status-disabled :status="{{ $member->disabled }}"></status-disabled>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="form-control-label">Weeks</label>
        <chart-bar-weeks :member="{{ $member }}"></chart-bar-weeks>
      </div>
    </div>
  </div>
@endsection
