@extends('layouts.default')

@section('content')
  <div class="page page-projects-index">
    <div class="page-header">
      <div class="row">
        <div class="col-xl-6">
          <h3 class="page-title">List of Projects</h3>

          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">List of Projects</li>
          </ol>
        </div>
        <div class="col-xl-6">
          <div class="tool-box">
            <field-search></field-search>
            <a class="btn btn-gold btn-create" href="{{ route('projects.create') }}">Create</a>
          </div>
        </div>
      </div>
    </div>

    <div class="table table-projects">
      <div class="table-header">
        <span class="table-column-title">
          #
        </span>
        <span class="table-column-title">
          Name of Project
        </span>
        <span class="table-column-title">
          Color
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
        @foreach ($projects as $project)
          <div class="table-row">
            <span class="table-cell">{{ $projects->firstItem() + $loop->index }}</span>
            <span class="table-cell">{{ $project->name }}</span>
            <span class="table-cell">
              <span class="color" style="background-color: {{ $project->color }}"></span>
            </span>
            <span class="table-cell">{{ $project->closed }}</span>
            <span class="table-cell">
              <time datetime="{{ $project->updated_at }}">{{ $project->updated_at->format('Y-m-d H:i') }}</time>
            </span>
            <span class="table-cell">
              <a class="" href="{{ route('projects.show', ['id' => $project->id]) }}">Show</a>
              <a class="" href="{{ route('projects.edit', ['id' => $project->id]) }}">Edit</a>
            </span>
          </div>
        @endforeach
      </div>
      <div class="table-footer">
        Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} entries

        {{ $projects->links('vendor.pagination.default') }}
      </div>
    </div>
  </div>
@endsection
