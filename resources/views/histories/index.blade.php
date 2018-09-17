@extends('layouts.default')

@section('content')
  <div class="page page-list page-history page-history-list">

    <div class="page-header">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <h2 class="title">Histories</h2>
            <div class="block-breadcrumb">
              <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="">Histories</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="block-search">
              <img class="icon" src="/images/blocks/block-search/icon-search.png" alt="" />
              <input type="text" class="form-control" placeholder="Type to search..."/>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="block-table block-table-histories">
              <div class="block-header">
                <span class="block-title">
                  Table
                </span>
                <span class="block-title">
                  Record Id
                </span>
                <span class="block-title">
                  Action
                </span>
                <span class="block-title">
                  Created
                </span>
              </div>
              <div class="block-content">
                @foreach ($histories as $history)
                  <div class="block-record">
                    <span class="block-cell">{{ $history->table_name }}</span>
                    <span class="block-cell">{{ $history->record_id }}</span>
                    <span class="block-cell">{{ $history->action }}</span>
                    <span class="block-cell">{{ $history->created_at }}</span>
                  </div>
                @endforeach
              </div>
              <div class="block-footer">
                Showing 1 to 17 of 17 entries

                {{ $histories->links('vendor.pagination.default') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
