@extends('layouts.auth')

@section('content')
  <div class="page page-login">

    <div class="page-header">
      <h4>Access Your Website</h4>
    </div>

    <div class="page-content">
      <form class="block-form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group">
          <label>Email address</label>
          <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="off">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" name="password" required autocomplete="off">
        </div>

        <button type="submit" class="btn btn-dark">Login</button>
      </form>
    </div>
  </div>
@endsection
