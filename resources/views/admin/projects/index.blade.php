@extends('layouts.app')

@section('content')
    @include('admin._nav', ['page' => 'projects'])

    <p><a href="{{ route('admin.projects.create') }}" class="btn btn-success">Add Project</a></p>

    <div class="card mb-3">
        <div class="card-header">Filter</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label">ID</label>
                            <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input id="name" class="form-control" name="name" value="{{ request('name') }}">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status</label>
                            <select id="status" class="form-control" name="status">
                                <option value=""></option>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}"{{ $value === request('status') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Manage</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td><a href="{{ route('admin.projects.edit', $project) }}">{{ $project->name }}</a></td>
                <td>
                    @if($project->isDisabled())
                        <span class="badge badge-danger">Disabled</span>
                    @else
                        <span class="badge badge-primary">Active</span>
                    @endif

                </td>
                <td>
                    <form method="POST" action="{{ route('admin.projects.switch', $project) }}" class="mr-1">
                        @csrf
                    @if($project->isDisabled())
                        <button class="badge-success btn btn-sm">Turn on</button>
                    @else
                        <button class="badge-danger btn btn-sm">Turn off</button>
                    @endif
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection