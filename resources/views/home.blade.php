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
        <charts-of-week :week="{{ $week }}"></charts-of-week>
      </section>
      @endif
    </div>
  </div>
@endsection
