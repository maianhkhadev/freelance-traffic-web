@extends('layouts.default')

@section('stylesheet')
  <link href="{{ asset('css/pages.show.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="page">
    <div class="page-header">
      <div class="col-xl-12">
        <div class="title">Overview Week {{ $week->name }}</div>
        <div class="breadcumb">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('weeks.index') }}">Weeks</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-6">
        <div class="form-group">
          <label>Name</label>
          <div>{{ $week->name }}</div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Data</label>
          <div><b>{{ count($projects) }}</b> Projects - <b>{{ count($week->tasks) }}</b> Tasks - <b>{{ count($members) }}</b> Members</div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group">
          <label>Status</label>
          <div>
            @if ($week->closed === 0)
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
          <label class="mb-0">Members</label>
          <small class="form-text text-muted">Select maximum 5 members.</small>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="teams">
          @foreach ($teams as $team)
            <div class="form-check team">
              <input class="form-check-input" type="checkbox" data-team-id="{{ $team->id }}" value="{{ $team->id }}" id="select-team-{{ $team->id }}">
              <label class="form-check-label" for="select-team-{{ $team->id }}">
                {{ $team->name }} Team
              </label>
            </div>
            <div class="members">
            @foreach ($members as $member)
              @if ($member->team_id === $team->id)
              <div class="form-check team-{{ $team->id }} member">
                <input class="form-check-input" type="checkbox" data-team-id="{{ $team->id }}" value="{{ $member->id }}" id="select-member-{{ $member->id }}">
                <label class="form-check-label" for="select-member-{{ $member->id }}">
                  {{ $member->name }}
                </label>
              </div>
              @endif
            @endforeach
            </div>
          @endforeach
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
          <label class="mb-0">Projects</label>
          <small class="form-text text-muted">Select maximum 5 projects.</small>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="projects">
          @foreach ($projects as $project)
          <div class="form-check project">
            <input class="form-check-input" type="checkbox" value="{{ $project->id }}" id="select-project-{{ $project->id }}">
            <label class="form-check-label" for="select-project-{{ $project->id }}">
              {{ $project->name }}
            </label>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-xl-9">
        <div class="chart-container">
          <canvas id="chart-projects"></canvas>
        </div>
      </div>
    </div>
    <div class="page-content">
      <div class="col-xl-12">
        <div class="form-group">
          <label>Tasks</label>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="50"></th>
                <th>Name</th>
                <th>Project</th>
                <th>Member</th>
                <th class="text-center">Value</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($week->tasks as $task)
              <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->project->name }}</td>
                <td>{{ $task->member->name }}</td>
                <td class="text-center">{{ $task->value }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <a class="btn btn-dark" href="{{ route('tasks.create') }}">New Task in this Week</a>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script>
    window.projects = []
    @foreach ($projects as $project)
      window.projects.push({
        id: {{ $project->id }},
        name: '{{ $project->name }}',
        value: {{ $project->value }}
      })
    @endforeach

    window.members = []
    @foreach ($members as $member)
      window.members.push({
        id: {{ $member->id }},
        name: '{{ $member->name }}',
        value: {{ $member->value }}
      })
    @endforeach

    function checkSelected (items, prefix) {
      items.forEach(function (item) {
        document.querySelector(`${prefix}-${item.id}`).setAttribute('checked', true)
      })
    }
    function findCheckedItems (items, checkBoxes) {
      let checkedItems = []
      checkBoxes.forEach(function (checkBox) {
        items.forEach(function (item) {
          if (item.id == checkBox.value) {
            checkedItems.push(item)
          }
        })
      })
      return checkedItems
    }
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
            xAxes: [{
              ticks: {
                display: false
              }
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

    function fetchData (chart, items) {
      chart.data.labels = []
      chart.data.datasets.forEach((dataset) => {
          dataset.data = []
      })
      items.forEach((item) => {
        chart.data.labels.push(item.name)
        chart.data.datasets.forEach((dataset) => {
          dataset.data.push(item.value)
        })
      })
      chart.update()
    }

    document.addEventListener('DOMContentLoaded', function() {
      let limit = 30;

      $('.team input[type=checkbox]').on('change', function(event) {
        if(event.target.checked) {
          let teamId = event.target.dataset.teamId
          let checkBoxes = document.querySelectorAll(`.team-${teamId} input[type=checkbox]`)
          checkBoxes.forEach(function(checkBox) {
            checkBox.checked = true
          })

          let checkBoxes = document.querySelectorAll('.member input[type=checkbox]:checked')
          let members = findCheckedItems(window.members, checkBoxes)
          fetchData(window.chart.members, members)
        }
      })

      $('.member input[type=checkbox]').on('change', function(event) {
        if ($('.member input[type=checkbox]:checked').length > limit) {
          $(this).prop('checked', false)
        }
        else {
          let checkBoxes = document.querySelectorAll('.member input[type=checkbox]:checked')
          let members = findCheckedItems(window.members, checkBoxes)
          fetchData(window.chart.members, members)
        }
      })

      $('.project input[type=checkbox]').on('change', function(event) {
        if ($('.project input[type=checkbox]:checked').length > limit) {
          $(this).prop('checked', false)
        }
        else {
          let checkBoxes = document.querySelectorAll('.project input[type=checkbox]:checked')
          let projects = findCheckedItems(window.projects, checkBoxes)
          fetchData(window.chart.projects, projects)
        }
      })

      window.chart = {}

      let members = _.take(window.members, limit)
      window.chart.members = renderChart('chart', members)
      checkSelected(members, '.member #select-member')

      let projects = _.take(window.projects, limit)
      window.chart.projects = renderChart('chart-projects', projects)
      checkSelected(projects, '.project #select-project')
    })

  </script>
@endsection
