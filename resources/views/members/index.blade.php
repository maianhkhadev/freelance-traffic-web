@extends('layouts.default')

@section('stylesheet')

@endsection

@section('content')
  <div class="page page-list page-member page-member-list">

    <div class="page-header">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <h2 class="title">Our Members</h2>
            <div class="block-breadcrumb">
              <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="">Members</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-2">
            <a class="btn btn-dark redirect-to-create" href="{{ route('members.create') }}">New Member</a>
          </div>
          <div class="col-xl-6">
            <div class="block-search">
              <img class="icon" src="/images/blocks/block-search/icon-search.png" alt="" />
              <input type="text" class="form-control" placeholder="Type to search..."/>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="block-table-actions">
              <a class="btn btn-dark" href="{{ route('members.create') }}">
                <img class="icon" src="/images/blocks/block-table-actions/icon-grid.png" alt=""/>
              </a>
              <a class="btn btn-dark" href="{{ route('members.create') }}">
                <img class="icon" src="/images/blocks/block-table-actions/icon-export.png" alt=""/>
              </a>
              <a class="btn btn-dark" href="{{ route('histories.index', ['table_name' => 'Member']) }}">
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
            <div class="block-table block-table-members" v-if="isSearch === false">
              <div class="block-header">
                <span class="block-title">
                  Name
                </span>
                <span class="block-title">
                  Email
                </span>
                <span class="block-title">
                  Status
                </span>
                <span class="block-title flex-center">
                  Update At
                </span>
                <span class="block-title">
                  Actions
                </span>
              </div>
              <div class="block-content">
                @foreach ($members as $member)
                  <block-record-member :data="{{ $member }}"></block-record-member>
                @endforeach

                @if (count($members) === 0)
                  <div class="not-found">No data found</div>
                @endif
              </div>
              <div class="block-footer">
                Showing {{ $members->firstItem() }} to {{ $members->lastItem() }} of {{ $members->total() }} entries

                {{ $members->links('vendor.pagination.default') }}
              </div>
            </div>

            <div class="block-table block-table-members" v-else>
              <div class="block-header">
                <span class="block-title">
                  Name
                </span>
                <span class="block-title">
                  Email
                </span>
                <span class="block-title">
                  Status
                </span>
                <span class="block-title flex-center">
                  Update At
                </span>
                <span class="block-title">
                  Actions
                </span>
              </div>
              <div class="block-content">
                <template v-for="member in members">
                  <block-record-member :data="member"></block-record-member>
                </template>

                <div class="not-found" v-if="members.length === 0">No data found</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
