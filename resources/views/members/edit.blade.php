@extends('layouts.default')

@section('stylesheet')
  <link href="{{ asset('css/pages.edit.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="page">
    <div class="page-header">
      <div class="col-xl-12">
        <div class="title">Edit Member {{ $member->name }}</div>
        <div class="breadcumb">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('members.index') }}">Members</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="page-content">
      <form action="/members/{{ $member->id }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-xl-6">
          <div class="form-group">
            <label>Name</label>
            <input name="name" type="text" class="form-control" placeholder="Enter name" value="{{ $member->name }}">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input name="email" type="text" class="form-control" placeholder="Enter email" value="{{ $member->email }}">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="checkbox-disabled" name="disabled" {{ $member->disabled === 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="checkbox-disabled">Disable this member</label>
          </div>

          <button class="btn btn-dark">Save & Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
