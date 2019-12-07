@extends('layouts.app')

@section('content')

        <p><a href="{{ route('log.create', $userId) }}" class="btn btn-primary mr-1">Add</a></p>

        <div class="card mb-3">
            <div class="card-header">Filter</div>
            <div class="card-body">
                <form action="?" method="GET">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="from_date" class="col-form-label">From date</label>
                                <input id="from_date" class="form-control"
                                       name="from_date"
                                       value="{{ request('from_date') }}">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="to_date" class="col-form-label">To date</label>
                                <input id="to_date" class="form-control"
                                       name="to_date"
                                       value="{{ request('to_date') }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="text" class="col-form-label">Text</label>
                                <input id="text" class="form-control"
                                       name="text"
                                       value="{{ request('text') }}">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="project" class="col-form-label">Project</label>
                                <select id="project" class="form-control" name="project">
                                    <option value=""></option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"{{ $project->id == request('project') ? ' selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach;
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label class="col-form-label">&nbsp;</label><br />
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>

                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label class="col-form-label">&nbsp;</label><br />
                                <button type="button" onclick="window.location = window.location.href.split('?')[0];" class="btn btn-primary">Reset</button>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Date</th>
                <th>Project</th>
                <th>Work log</th>
                <th>Time</th>
                <th>Manage</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($logs as $log)
            <tr>
                <td><a href="{{ route('log.edit', [$userId, $log]) }}">
                    {{ \Illuminate\Support\Carbon::createFromDate($log->date)->format('d.m.Y') }}
                    </a>
                </td>
                <td>{{ $log->project->name }}</td>
                <td><a href="{{ $log->link }}" target="_blank">{{ $log->text }}</a></td>
                <td>{{ $log->time}}</td>
                <td>
                    <form method="POST" action="{{ route('log.destroy', [$userId, $log]) }}" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total: </strong></td>
                <td><strong>{{ $time_total }}</strong></td>
                <td></td>
            </tr>
            </tbody>
        </table>


@endsection