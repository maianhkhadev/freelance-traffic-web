<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.default.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="root">
      <header>
        <div class="container">
          <div class="row">
            <div class="col-6">
              <a class="home" href="{{ route('home') }}">Focus Asia</a>
            </div>
            <div class="col-6">
              <div class="user">
                <div class="name">{{ auth()->user()->name }}</div>
                <a class="action" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Click to sign out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </div>
            </div>
          </div>
        </div>
      </header>

      <main class="main">
        @yield('content')
      </main>

      <footer>
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="copyright">Copyright © 2018</div
            </div>
          </div>
        </div>
      </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('javascript')
</body>
</html>
