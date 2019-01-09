@extends('layouts.auth')

@section('content')
  <div class="card">
    <div class="card-header text-center">Access Your Website</div>

    <div class="card-body">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
          <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

          @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group">
          <label for="password" class="col-form-label">{{ __('Password') }}</label>
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

          @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>

        <button type="submit" class="btn btn-gold btn-block">
          {{ __('Login') }}
        </button>
      </form>
    </div>
  </div>
@endsection
