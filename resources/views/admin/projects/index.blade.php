@extends('layouts.app')

@section('content')
    @include('admin._nav', ['page' => 'projects'])

    <p><a href="{{ route('admin.projects.create') }}" class="btn btn-success">Add Project</a></p>

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