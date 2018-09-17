@extends('layouts.default')

@section('stylesheet')

@endsection

@section('content')
  <div class="page page-list page-week page-week-list">

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
              <a class="btn btn-dark" href="{{ route('histories.index', ['table_name' => 'Week']) }}">
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
            <div class="block-table" v-if="isSearch === false">
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
                  <block-record-week :data="{{ $week }}"></block-record-week>
                @endforeach
              </div>

              <div class="block-footer">
                Showing 1 to 17 of 17 entries

                {{ $weeks->links('vendor.pagination.default') }}
              </div>
            </div>

            <div class="block-table" v-else>
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
                <template v-for="week in weeks">
                  <block-record-week :data="week"></block-record-week>
                </template>

                <div class="not-found" v-if="weeks.length === 0">
                  No data found
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
