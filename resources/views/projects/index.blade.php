@extends('layouts.default')

@section('content')
  <div class="page page-list page-project page-project-list">

    <div class="page-header">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <h2 class="title">Our Projects</h2>
            <div class="block-breadcrumb">
              <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="">Projects</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-2">
            <a class="btn btn-dark redirect-to-create" href="{{ route('projects.create') }}">New Project</a>
          </div>
          <div class="col-xl-6">
            <div class="block-search">
              <img class="icon" src="/images/blocks/block-search/icon-search.png" alt="" />
              <input type="text" class="form-control" placeholder="Type to search..."/>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="block-table-actions">
              <a class="btn btn-dark" href="{{ route('projects.create') }}">
                <img class="icon" src="/images/blocks/block-table-actions/icon-grid.png" alt=""/>
              </a>
              <a class="btn btn-dark" href="{{ route('projects.create') }}">
                <img class="icon" src="/images/blocks/block-table-actions/icon-export.png" alt=""/>
              </a>
              <a class="btn btn-dark" href="{{ route('histories.index', ['table_name' => 'Task']) }}">
                <img class="icon" src="/images/blocks/block-table-actions/icon-history.png" alt=""/>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="block-table block-table-projects" v-if="isSearch === false">
              <div class="block-header">
                <span class="block-title">
                  Name
                </span>
                <span class="block-title">
                  Description
                </span>
                <span class="block-title">
                  Status
                </span>
                <span class="block-title flex-center">
                  Update At
                </span>
                <span class="block-title">
                  Actions
                </span>
              </div>
              <div class="block-content">
                @foreach ($projects as $project)
                  <block-record-project :data="{{ $project }}"></block-record-project>
                @endforeach

                @if (count($projects) === 0)
                  <div class="not-found">No data found</div>
                @endif
              </div>
              <div class="block-footer">
                Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} entries

                {{ $projects->links('vendor.pagination.default') }}
              </div>
            </div>

            <div class="block-table block-table-projects" v-else>
              <div class="block-header">
                <span class="block-title">
                  Name
                </span>
                <span class="block-title">
                  Description
                </span>
                <span class="block-title">
                  Status
                </span>
                <span class="block-title flex-center">
                  Update At
                </span>
                <span class="block-title">
                  Actions
                </span>
              </div>
              <div class="block-content">
                <template v-for="project in projects">
                  <block-record-project :data="project"></block-record-project>
                </template>

                <div class="not-found" v-if="projects.length === 0">No data found</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
