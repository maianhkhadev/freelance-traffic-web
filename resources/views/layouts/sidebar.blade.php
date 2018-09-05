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
  <div id="root" class="layout-sidebar">
    <header>
      <div class="align-self-center">
        <a class="home" href="{{ route('home') }}">Focus Asia</a>
      </div>
      <div class="user">
        <div class="name">{{ auth()->user()->name }}</div>
        <a class="action" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Click to sign out
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </div>
    </header>

    <main class="main">
      <div class="main-sidebar">
        <ul class="menu">
          <li class="menu-item">
            <a class="menu-link" href="{{ route('tasks.create') }}">
              <img class="icon" src="/images/im-02.png" alt=""/>
              Create A New Task
            </a>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="#">
              <img class="icon" src="/images/im-01.png" alt=""/>
              View Lastest Week
            </a>
          </li>
          <li class="menu-item has-sub">
            <a class="menu-link">
              <img class="icon" src="/images/weeks.png" alt=""/>
              Weeks
            </a>
            <ul class="sub-menu">
              <li class="menu-item">
                <a class="menu-link" href="{{ route('weeks.create') }}">New Week</a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="{{ route('weeks.index') }}">List of Week</a>
              </li>
            </ul>
          </li>
          <li class="menu-item has-sub">
            <a class="menu-link">
              <img class="icon" src="/images/projects.png" alt=""/>
              Projects
            </a>
            <ul class="sub-menu">
              <li class="menu-item">
                <a class="menu-link" href="{{ route('projects.create') }}">New Project</a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="{{ route('projects.index') }}">List of Project</a>
              </li>
            </ul>
          </li>
          <li class="menu-item has-sub">
            <a class="menu-link">
              <img class="icon" src="/images/weeks.png" alt=""/>
              Teams
            </a>
            <ul class="sub-menu">
              <li class="menu-item">
                <a class="menu-link" href="{{ route('teams.create') }}">New Team</a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="{{ route('teams.index') }}">List of Team</a>
              </li>
            </ul>
          </li>
          <li class="menu-item has-sub">
            <a class="menu-link">
              <img class="icon" src="/images/members.png" alt=""/>
              Members
            </a>
            <ul class="sub-menu">
              <li class="menu-item">
                <a class="menu-link" href="{{ route('members.create') }}">New Member</a>
              </li>
              <li class="menu-item">
                <a class="menu-link" href="{{ route('members.index') }}">List of Member</a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a class="menu-link" href="#">
              <img class="icon" src="/images/weeks.png" alt=""/>
              Change Password
            </a>
          </li>
        </ul>
      </div>
      <div class="main-content">
        @yield('content')

        <footer>
          <div class="copyright">Copyright © 2018</div>
        </footer>
      </div>
    </main>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/manifest.js') }}"></script>
  <script src="{{ asset('js/vendor.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('javascript')
</body>
</html>
