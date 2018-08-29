@extends('layouts.default')

@section('stylesheet')
  <link href="{{ asset('css/pages.index.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xl-12 mb-3">
        <a class="btn btn-dark" href="{{ route('projects.create') }}">New Project</a>
      </div>
      <div class="col-xl-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="50"></th>
              <th>Name</th>
              <th class="text-center" width="120">Status</th>
              <th class="text-center" width="200">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projects as $project)
            <tr>
              <td class="text-center">{{ $loop->index + 1 }}</td>
              <td>{{ $project->name }}</td>
              <td class="text-center">
                @if ($project->closed === 0)
                  <span class="badge badge-success">opened</span>
                @else
                  <span class="badge badge-secondary">closed</span>
                @endif
              </td>
              <td class="text-center">
                <a class="btn btn-dark" href="{{ route('projects.show', ['id' => $project->id]) }}">View</a>
                <a class="btn btn-dark" href="{{ route('projects.edit', ['id' => $project->id]) }}">Edit</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
