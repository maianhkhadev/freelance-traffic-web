@extends('layouts.default')

@section('stylesheet')
  <link href="{{ asset('css/pages.index.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xl-12 mb-3">
        <a class="btn btn-dark" href="{{ route('members.create') }}">New Member</a>
      </div>
      <div class="col-xl-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th width="50"></th>
              <th>Name</th>
              <th>Email</th>
              <th class="text-center" width="120">Status</th>
              <th class="text-center" width="200">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members as $member)
            <tr>
              <td class="text-center">{{ $loop->index + 1 }}</td>
              <td>{{ $member->name }}</td>
              <td>{{ $member->email }}</td>
              <td class="text-center">
                @if ($member->disabled === 0)
                  <span class="badge badge-success">actived</span>
                @else
                  <span class="badge badge-secondary">disabled</span>
                @endif
              </td>
              <td class="text-center">
                <a class="btn btn-dark" href="{{ route('members.show', ['id' => $member->id]) }}">View</a>
                <a class="btn btn-dark" href="{{ route('members.edit', ['id' => $member->id]) }}">Edit</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
