@extends('layouts.default')

@section('content')
  <div class="page page-kickoff">
    <div class="page-header">
      <h3 class="page-title">Kick Off</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kick Off</li>
      </ol>
    </div>

    <div class="page-content">
      <form class="form" action="/kickoff" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <section class="section">
          <h4 class="section-title">Create a Week</h4>

          <div class="row">
            <div class="col-xl-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Ex: Week 10 - 2018" autocomplete="off" required>
              </div>

              <div class="form-group">
                <label>Start date</label>
                <flatpickr name="start_date"></flatpickr>
                <small class="form-text text-muted">Help us to sort data.</small>
              </div>
            </div>
          </div>
        </section>

        <section class="section">
          <h4 class="section-title">Create Tasks</h4>

          <create-multi-tasks ref="tasks" :projects="{{ $projects }}" :members="{{ $members }}"></create-multi-tasks>
        </section>

        <div class="form-footer">
          <a class="btn btn-secondary" href="{{ route('home') }}">Cancel</a>
          <button class="btn btn-white">New Task</button>
          <button class="btn btn-gold">Save & Close</button>
        </div>
      </form>
    </div>
  </div>
@endsection
