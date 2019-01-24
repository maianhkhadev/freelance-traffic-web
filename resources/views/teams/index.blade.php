@extends('layouts.default')

@section('content')
  <div class="page page-teams-index">
    <div class="page-header">
      <div class="row">
        <div class="col-xl-6">
          <h3 class="page-title">List of Teams</h3>

          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List of Teams</li>
          </ol>
        </div>
        <div class="col-xl-6">
          <div class="tool-box">
            <field-search></field-search>
            <a class="btn btn-gold btn-create" href="{{ route('teams.create') }}">Create</a>
          </div>
        </div>
      </div>
    </div>

    <div class="table table-teams">
      <div class="table-header">
        <span class="table-column-title">
          #
        </span>
        <span class="table-column-title">
          Name of Team
        </span>
        <span class="table-column-title">
          Color
        </span>
        <span class="table-column-title">
          Update At
        </span>
        <span class="table-column-title">
          Actions
        </span>
      </div>
      <div class="table-content">
        @foreach ($teams as $team)
          <div class="table-row">
            <span class="table-cell">{{ $teams->firstItem() + $loop->index }}</span>
            <span class="table-cell">{{ $team->name }}</span>
            <span class="table-cell">
              <span class="color" style="background-color: {{ $team->color }}"></span>
            </span>
            <span class="table-cell">
              <time datetime="{{ $team->updated_at }}">{{ $team->updated_at->format('Y-m-d H:i') }}</time>
            </span>
            <span class="table-cell">
              <a class="" href="{{ route('teams.edit', ['id' => $team->id]) }}">Edit</a>
            </span>
          </div>
        @endforeach
      </div>
      <div class="table-footer">
        Showing {{ $teams->firstItem() }} to {{ $teams->lastItem() }} of {{ $teams->total() }} entries

        {{ $teams->links('vendor.pagination.default') }}
      </div>
    </div>
  </div>
@endsection
