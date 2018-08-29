@extends('layouts.default')

@section('stylesheet')
  <link href="{{ asset('css/pages.show.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="page">
    <div class="page-header">
      <div class="col-xl-12">
        <div class="title">Overview Member {{ $member->name }}</div>
        <div class="breadcumb">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('members.index') }}">Members</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-6">
        <div class="form-group">
          <label>Name</label>
          <div>{{ $member->name }}</div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Email</label>
          <div>{{ $member->email }}</div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Status</label>
          <div>
            @if ($member->disabled === 0)
              <span class="badge badge-success">actived</span>
            @else
              <span class="badge badge-secondary">disabled</span>
            @endif
          </div>
        </div>
      </div>
      {{-- <div class="col-xl-6">
        <div class="form-group">
          <label>All time</label>
          <div><b>{{ count($projects) }}</b> Projects - <b>{{ count($weeks) }}</b> Weeks - <b>{{ count($member->tasks) }}</b> Tasks</div>
        </div>
      </div> --}}
    </div>
    <div class="page-content">
      <div class="col-xl-4">
        <div class="form-group">
          <label>Choose a Week</label>
          <select name="week_id" class="form-control" value="{{ $week->id }}">
            @foreach ($weeks as $week)
            <option value="{{ $week->id }}">{{ $week->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <div class="mb-3">- <b>{{ count($projects) }}</b> Projects</div>
          <div class="mb-3">- <b>{{ count($tasks) }}</b> Tasks</div>
          {{-- <div class="mb-3">- <b>{{ $latest_week_value }}</b> Values</div> --}}
        </div>
      </div>
      <div class="col-xl-8">
        <div class="chart-container">
          <canvas id="chart"></canvas>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-12">
        <div class="form-group">
          <label>Tasks of the Week thet you choose</label>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="50"></th>
                <th>Name</th>
                <th>Project</th>
                <th>Week</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tasks as $task)
              <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->project->name }}</td>
                <td>{{ $task->week->name }}</td>
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
  <script src="{{ asset('js/members.show.js') }}"></script>

  <script>
    window.memberId = {{ $member->id }}
    window.tasks = []
    @foreach ($tasks as $task)
      window.tasks.push({
        id: {{ $task->id }},
        name: '{{ $task->name }}',
        value: {{ $task->value }}
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
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            data: values,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)'
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
      renderChart('chart', window.tasks)
    })

  </script>
@endsection
