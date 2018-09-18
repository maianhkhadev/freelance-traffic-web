@extends('layouts.default')

@section('content')
  <div class="page page-list page-team page-team-list">

    <div class="page-header">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <h2 class="title">All Our Teams</h2>
            <div class="block-breadcrumb">
              <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="">Teams</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="block-table block-table-teams">
              <div class="block-header">
                <span class="block-title">
                  Team
                </span>
                <span class="block-title">
                  Leader
                </span>
                <span class="block-title">
                  Active Members
                </span>
              </div>

              <div class="block-content">
                @foreach ($teams as $team)
                <div class="block-record">
                  <span class="block-cell">{{ $team->name }}</span>
                  <span class="block-cell">Admin</span>
                  <span class="block-cell">
                    @foreach ($team->members as $member)
                      @if ($member->disabled === 0)
                        <avatar-name :data="{{ $member }}"></avatar-name>
                      @endif
                    @endforeach
                  </span>
                </div>
                @endforeach
              </div>

              <div class="block-footer">
                Showing {{ $teams->firstItem() }} to {{ $teams->lastItem() }} of {{ $teams->total() }} entries

                {{ $teams->links('vendor.pagination.default') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
