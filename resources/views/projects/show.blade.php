@extends('layouts.default')

@section('stylesheet')
  <link href="{{ asset('css/pages.show.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="page">
    <div class="page-header">
      <div class="col-xl-12">
        <div class="title">Overview Project {{ $project->name }}</div>
        <div class="breadcumb">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-6">
        <div class="form-group">
          <label>Name</label>
          <div>{{ $project->name }}</div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Data</label>
          <div><b>{{ count($weeks) }}</b> Weeks - <b>{{ count($project->tasks) }}</b> Tasks - <b>{{ count($members) }}</b> Members</div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Status</label>
          <div>
            @if ($project->closed === 0)
              <span class="badge badge-success">opened</span>
            @else
              <span class="badge badge-secondary">closed</span>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-12">
        <div class="form-group">
          <label>Process</label>
          <div class="chart-container">
            <canvas id="chart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-6">
        <div class="form-group">
          <label>Members</label>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($members as $member)
              <tr>
                <td>{{ $member->name }}</td>
                <td class="text-center">{{ $member->value }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Weeks</label>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($weeks as $week)
              <tr>
                <td><a href="/weeks/{{ $week->id }}" target="_blank">{{ $week->name }}</td>
                <td class="text-center">{{ $week->value }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-xl-12">
        <div class="form-group">
          <label>Tasks</label>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="50"></th>
                <th>Name</th>
                <th>Week</th>
                <th>Member</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($project->tasks as $task)
              <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->week->name }}</td>
                <td>{{ $task->member->name }}</td>
                <td class="text-center">{{ $task->value }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script>
    window.weeks = []
    @foreach ($weeks as $week)
      window.weeks.push({
        id: {{ $week->id }},
        name: '{{ $week->name }}',
        value: {{ $week->value }}
      })
    @endforeach

    function renderChart (chartId, members) {
      let labels = []
      let values = []
      members.forEach(function (member) {
        labels.push(member.name)
        values.push(member.value)
      })

      var context = document.getElementById(chartId).getContext('2d')
      let chart = new Chart(context, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            data: values,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
              'rgba(255,99,132,1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              display: false
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      })

      return chart
    }

    $(document).ready(function () {
      renderChart('chart', window.weeks)
    })

  </script>
@endsection
