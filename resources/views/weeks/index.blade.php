@extends('layouts.default')

@section('stylesheet')
  <link href="{{ asset('css/pages.index.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xl-12 mb-3">
        <a class="btn btn-dark" href="{{ route('weeks.create') }}">New Week</a>
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
            @foreach ($weeks as $week)
            <tr>
              <td class="text-center">{{ $loop->index + 1 }}</td>
              <td>{{ $week->name }}</td>
              <td class="text-center">
                @if ($week->closed === 0)
                  <span class="badge badge-success">opened</span>
                @else
                  <span class="badge badge-secondary">closed</span>
                @endif
              </td>
              <td class="text-center">
                <a class="btn btn-dark" href="{{ route('weeks.show', ['id' => $week->id]) }}">View</a>
                <a class="btn btn-dark" href="{{ route('weeks.edit', ['id' => $week->id]) }}">Edit</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
