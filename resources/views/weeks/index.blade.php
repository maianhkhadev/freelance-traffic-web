@extends('layouts.default')

@section('stylesheet')

@endsection

@section('content')
  <div class="page page-list">

    <div class="page-header">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <h2 class="title">Working Weeks</h2>
            <div class="block-breadcrumb">
              <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="">Weeks</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-2">
            <a class="btn btn-dark redirect-to-create" href="{{ route('weeks.create') }}">New Week</a>
          </div>
          <div class="col-xl-6">
            <div class="block-search">
              <img class="icon" src="/images/blocks/block-search/icon-search.png" alt="" />
              <input type="text" class="form-control" placeholder="Type to search..."/>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="block-table-actions">
              <a class="btn btn-dark" href="{{ route('weeks.create') }}">
                <img class="icon" src="/images/blocks/block-table-actions/icon-grid.png" alt=""/>
              </a>
              <a class="btn btn-dark" href="{{ route('weeks.create') }}">
                <img class="icon" src="/images/blocks/block-table-actions/icon-export.png" alt=""/>
              </a>
              <a class="btn btn-dark" href="{{ route('weeks.create') }}">
                <img class="icon" src="/images/blocks/block-table-actions/icon-history.png" alt=""/>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="block-table">
              <div class="block-header">
                <span class="block-title">
                  Week
                </span>
                <span class="block-title">
                  From { date } to { date }
                </span>
                <span class="block-title">
                  Status
                </span>
                <span class="block-title">
                  Actions
                </span>
              </div>
              <div class="block-content">
                @foreach ($weeks as $week)
                <div class="block-record">
                  <span class="block-cell">{{ $week->name }}</span>
                  <span class="block-cell">{{ $week->name }}</span>
                  <span class="block-cell">
                    @if ($week->closed === 0)
                      <span class="badge badge-success">opened</span>
                    @else
                      <span class="badge badge-secondary">closed</span>
                    @endif
                  </span>
                  <span class="block-cell">
                    <a class="" href="{{ route('weeks.show', ['id' => $week->id]) }}">Show</a>
                    <a class="" href="{{ route('weeks.edit', ['id' => $week->id]) }}">Edit</a>
                    <a class="remove" href="{{ route('weeks.edit', ['id' => $week->id]) }}">Close</a>
                  </span>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 align-self-center">
            Showing 1 to 17 of 17 entries
          </div>
          <div class="col-xl-6">
            {{ $weeks->links('vendor.pagination.default') }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
