@extends('layouts.default')

@section('content')
  <div class="page page-members-index">
    <div class="page-header">
      <div class="row">
        <div class="col-xl-6">
          <h3 class="page-title">List of Members</h3>

          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List of Members</li>
          </ol>
        </div>
        <div class="col-xl-6">
          <div class="tool-box">
            <div class="field-search">
              <img class="icon" src="/images/icon-search.png" alt="" />
              <input type="text" class="form-control" placeholder="Type to search..."/>
            </div>
            <a class="btn btn-gold btn-create" href="{{ route('members.create') }}">Create</a>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="table table-members">
        <div class="table-header">
          <span class="table-column-title">
            #
          </span>
          <span class="table-column-title">
            Name of Member
          </span>
          <span class="table-column-title">
            Email
          </span>
          <span class="table-column-title">
            Status
          </span>
          <span class="table-column-title">
            Update At
          </span>
          <span class="table-column-title">
            Actions
          </span>
        </div>
        <div class="table-content">
          @foreach ($members as $member)
            <div class="table-row">
              <span class="table-cell">{{ $members->firstItem() + $loop->index }}</span>
              <span class="table-cell">{{ $member->name }}</span>
              <span class="table-cell">{{ $member->email }}</span>
              <span class="table-cell">
                <status-disabled :status="{{ $member->disabled }}"></status-disabled>
              </span>
              <span class="table-cell">
                <time datetime="{{ $member->updated_at }}">{{ $member->updated_at->format('Y-m-d H:i') }}</time>
              </span>
              <span class="table-cell">
                <a class="" href="{{ route('members.show', ['id' => $member->id]) }}">Show</a>
                <a class="" href="{{ route('members.edit', ['id' => $member->id]) }}">Edit</a>
              </span>
            </div>
          @endforeach
        </div>
        <div class="table-footer">
          Showing {{ $members->firstItem() }} to {{ $members->lastItem() }} of {{ $members->total() }} entries

          {{ $members->links('vendor.pagination.default') }}
        </div>
      </div>
    </div>
  </div>
@endsection
