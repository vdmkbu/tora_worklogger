@extends('layouts.app')

@section('content')
    @include('admin._nav', ['page' => 'reports'])

    @include('admin.reports._nav', ['report' => 'positions'])

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
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="position" class="col-form-label">Position</label>
                            <select id="position" class="form-control" name="position">
                                <option value=""></option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"{{ $position->id == request('position') ? ' selected' : '' }}>
                                        {{ $position->name }}
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
            <th>Interval</th>
            <th>Position</th>
            <th>Time total</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($logs as $log)
            <tr>
                <td>{{ $interval['start'] }} — {{ $interval['end'] }}</td>
                <td>{{ $log->position }}</td>
                <td>{{ $log->time }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection