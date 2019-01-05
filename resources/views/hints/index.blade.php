@extends('layouts.default')

@section('content')
  <div class="page">
    <div class="page-header">
      <div class="row">
        <div class="col-xl-6">
          <h3 class="page-title">List of Hints</h3>

          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List of Hints</li>
          </ol>
        </div>
        <div class="col-xl-6">
          <div class="tool-box">
            <div class="field-search">
              <img class="icon" src="/images/icon-search.png" alt="" />
              <input type="text" class="form-control" placeholder="Type to search..."/>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="table table-weeks">
      <div class="table-header">
        <span class="table-column-title">
          #
        </span>
        <span class="table-column-title">
          Value
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
        @foreach ($weeks as $week)
          <div class="table-row">
            <span class="table-cell">{{ $weeks->firstItem() + $loop->index }}</span>
            <span class="table-cell">{{ $week->name }}</span>
            <span class="table-cell">{{ $week->closed }}</span>
            <span class="table-cell">
              <time datetime="{{ $week->updated_at }}">{{ $week->updated_at->format('Y-m-d H:i') }}</time>
            </span>
            <span class="table-cell">
              <a class="" href="{{ route('weeks.show', ['id' => $week->id]) }}">Delete</a>
            </span>
          </div>
        @endforeach
      </div>
      <div class="table-footer">
        Showing {{ $weeks->firstItem() }} to {{ $weeks->lastItem() }} of {{ $weeks->total() }} entries

        {{ $weeks->links('vendor.pagination.default') }}
      </div>
    </div>
  </div>
@endsection
