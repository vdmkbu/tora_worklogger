@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('log.update', [$user, $log]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date" class="col-form-label">Date</label>
            <input id="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                   name="date"
                   value="{{ old('name', $log->date) }}" required>
            @if ($errors->has('date'))
                <span class="invalid-feedback"><strong>{{ $errors->first('date') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="project" class="col-form-label">Project</label>
            <select id="project" class="form-control{{ $errors->has('position_id') ? ' is-invalid' : '' }}"
                    name="project_id">
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}"
                            {{ $project->id === old('project_id', $log->project->id) ? ' selected' : '' }}
                    >
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('project_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('project_id') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="text" class="col-form-label">Text</label>
            <textarea id="date"
                      class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}"
                      name="text" required>{{ $log->text }}</textarea>
            @if ($errors->has('text'))
                <span class="invalid-feedback"><strong>{{ $errors->first('text') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="link" class="col-form-label">Link</label>
            <input id="link" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}"
                   name="link"
                   value="{{ old('link', $log->link) }}" required>
            @if ($errors->has('link'))
                <span class="invalid-feedback"><strong>{{ $errors->first('link') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="time" class="col-form-label">Time</label>
            <select id="time" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}"
                    name="time">
                @foreach ($time_list as $time)
                    <option value="{{ $time }}"
                            {{ $time === old('time', $log->time) ? ' selected' : '' }}
                    >
                        {{ $time }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('time'))
                <span class="invalid-feedback"><strong>{{ $errors->first('time') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>

    </form>
@endsection