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
              <a class="btn btn-dark" href="{{ route('members.create') }}">
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
                  Name
                </span>
                <span class="block-title">
                  Email
                </span>
                <span class="block-title">
                  Status
                </span>
                <span class="block-title">
                  Actions
                </span>
              </div>
              <div class="block-content">
                @foreach ($members as $member)
                <div class="block-record {{ $member->updated_at }}">
                  <span class="block-cell">
                    <span class="avatar-name">HL</span>
                    {{ $member->name }}
                  </span>
                  <span class="block-cell">{{ $member->email }}</span>
                  <span class="block-cell">
                    @if ($member->disabled === 0)
                      <span class="badge badge-success">actived</span>
                    @else
                      <span class="badge badge-secondary">disabled</span>
                    @endif
                  </span>
                  <span class="block-cell">
                    <a class="" href="{{ route('members.show', ['id' => $member->id]) }}">Show</a>
                    <a class="" href="{{ route('members.edit', ['id' => $member->id]) }}">Edit</a>
                    <a class="remove delete" data-member-id={{ $member->id }} href="#">Remove</a>
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
            {{ $members->links('vendor.pagination.default') }}
          </div>
        </div>
      </div>
    </div>

    <form class="modal-content" action="/members/10" method="GET">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="DELETE">
      <button type="submit" class="btn btn-danger">Remove</button>
    </form>

    <div class="modal modal-member-delete fade">
      <div class="modal-dialog">
        <form class="modal-content" action="/members/10" method="POST">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          {{-- <input type="hidden" name="id" value=""> --}}
          <button type="submit" class="btn btn-danger">Remove</button>
          {{-- <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Do you want remove this member?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Remove</button>
          </div> --}}
        </form>
      </div>
    </div>
  </div>
@endsection
