@extends('layouts.default')

@section('content')
  <div class="page page-home">
    <div class="page-header">
      <h3 class="page-title">Home</h3>

      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Home</li>
      </ol>
    </div>

    <div class="page-content">
      @if ($week !== NULL)
      <section class="section">
        <h4 class="section-title">Latest week: {{ $week->name }}</h4>

        <div class="row">
          <div class="col-xl-6">
            <div class="form-group">
              <label class="form-control-label">Projects</label>
              <chart-pie-projects :week="{{ $week }}"></chart-pie-projects>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="form-group">
              <label class="form-control-label">Teams</label>
              <chart-pie-teams :week="{{ $week }}"></chart-pie-teams>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="form-control-label">Members</label>
          <chart-bar-members :week="{{ $week }}"></chart-bar-members>
        </div>
      </section>
      @endif
    </div>
  </div>
@endsection
