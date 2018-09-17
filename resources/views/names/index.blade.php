@extends('layouts.default')

@section('content')
  <div class="page page-list page-history page-history-list">

    <div class="page-header">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <h2 class="title">Names Of Task</h2>
            <div class="block-breadcrumb">
              <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="">Names Of Task</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-2">
            <a class="btn btn-dark redirect-to-create" href="{{ route('names.create') }}">New Name</a>
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
            <div class="block-table block-table-names">
              <div class="block-header">
                <span class="block-title">
                  Name
                </span>
                <span class="block-title">
                  Created
                </span>
                <span class="block-title">
                  Actions
                </span>
              </div>
              <div class="block-content">
                @foreach ($names as $name)
                <div class="block-record">
                  <span class="block-cell">{{ $name->value }}</span>
                  <span class="block-cell">{{ $name->created_at }}</span>
                  <span class="block-cell">
                    <a class="note-link" href="{{ route('names.edit', ['id' => $name->id ]) }}">Edit</a>
                  </span>
                </div>
                @endforeach
              </div>
              <div class="block-footer">
                Showing 1 to 17 of 17 entries

                {{ $names->links('vendor.pagination.default') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
