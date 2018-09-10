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
    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
    <div id="root" class="layout-default">
      <header>
        <div class="container">
          <div class="row">
            <div class="col-6">
              <a class="navi-brand" href="{{ route('home') }}">Focus Asia</a>
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
            <div class="col-xl-12">
              <nav class="navi-bar">

                <ul class="navi">
                  <li class="navi-item">
                    <a class="navi-link" href="{{ route('tasks.create') }}">Create A New Task</a>
                  </li>
                  <li class="navi-item navi-item-project has-sub">
                    <a class="navi-link">Projects</a>

                    <ul class="sub-navi">
                      <li class="sub-navi-item">
                        <a class="sub-navi-link" href="{{ route('projects.create') }}">Create a new Project</a>
                      </li>
                      <li class="sub-navi-item">
                        <a class="sub-navi-link" href="{{ route('projects.index') }}">List of Project</a>
                      </li>
                    </ul>
                  </li>
                  <li class="navi-item navi-item-week has-sub">
                    <a class="navi-link">Weeks</a>

                    <ul class="sub-navi">
                      <li class="sub-navi-item">
                        <a class="sub-navi-link" href="{{ route('weeks.create') }}">Create a new Week</a>
                      </li>
                      <li class="sub-navi-item">
                        <a class="sub-navi-link" href="{{ route('weeks.index') }}">List of Week</a>
                      </li>
                    </ul>
                  </li>
                  <li class="navi-item navi-item-team has-sub">
                    <a class="navi-link">Teams</a>

                    <ul class="sub-navi">
                      <li class="sub-navi-item">
                        <a class="sub-navi-link" href="{{ route('teams.index') }}">List of Team</a>
                      </li>
                    </ul>
                  </li>
                  <li class="navi-item navi-item-member has-sub">
                    <a class="navi-link">Members</a>

                    <ul class="sub-navi">
                      <li class="sub-navi-item">
                        <a class="sub-navi-link" href="{{ route('members.create') }}">Create a new Member</a>
                      </li>
                      <li class="sub-navi-item">
                        <a class="sub-navi-link" href="{{ route('members.index') }}">List of Member</a>
                      </li>
                    </ul>
                  </li>
                  <li class="navi-item has-sub">
                    <a class="navi-link">Settings</a>

                    <ul class="sub-navi">
                      <li class="sub-navi-item">
                        <a class="sub-navi-link" href="#">Change password</a>
                      </li>
                      <li class="sub-navi-item">
                        <a class="sub-navi-link" href="#">Create a new Account</a>
                      </li>
                    </ul>
                  </li>
                </ul>

                <button class="navi-icon">
                  <span class="icon">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
                </button>
              </nav>
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
