@extends('layouts.default')

@section('content')
  <div class="page">
    <div class="page-header">
      <div class="row">
        <div class="col-xl-6">
          <h3 class="page-title">List of Works</h3>

          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List of Works</li>
          </ol>
        </div>

        <div class="col-xl-2 ml-auto">
          <a class="btn btn-gold btn-create" href="{{ route('works.create') }}">Create</a>
        </div>
      </div>
    </div>

    <div class="table table-works">
      <div class="table-header">
        <span class="table-column-title">
          #
        </span>
        <span class="table-column-title">
          Parent
        </span>
        <span class="table-column-title">
          Name
        </span>
        <span class="table-column-title">
          Update At
        </span>
        <span class="table-column-title">
          Actions
        </span>
      </div>
      <div class="table-content">
        @foreach ($works as $work)
          <div class="table-row">
            <span class="table-cell">{{ $loop->index + 1 }}</span>
            <span class="table-cell">
              @if ($work->parent !== null)
                {{ $work->parent->name }}
              @endif
            </span>
            <span class="table-cell">{{ $work->name }}</span>
            <span class="table-cell">
              <time datetime="{{ $work->updated_at }}">{{ $work->updated_at->format('Y-m-d H:i') }}</time>
            </span>
            <span class="table-cell">
              <a class="" href="{{ route('works.edit', ['id' => $work->id]) }}">Edit</a>
            </span>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
