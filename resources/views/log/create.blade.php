@extends('layouts.app')

@section('content')
    <h2>Add new worklog</h2>
    <form method="POST" action="{{ route('log.store', $user) }}">
        @csrf

        <div class="form-group">
            <label for="date" class="col-form-label">Date</label>
            <input id="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ \Illuminate\Support\Carbon::now()->format('Y-m-d') }}" required>
            @if ($errors->has('date'))
                <span class="invalid-feedback"><strong>{{ $errors->first('date') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="project_id" class="col-form-label">Project</label>
            <select id="project_id" class="form-control{{ $errors->has('project_id') ? ' is-invalid' : '' }}"
                    name="project_id">
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">
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
                      name="text" required>
                {{ old('text') }}
            </textarea>
            @if ($errors->has('text'))
                <span class="invalid-feedback"><strong>{{ $errors->first('text') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="link" class="col-form-label">Link for text</label>
            <input id="link" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}"
                   name="link" value="{{ old('link') }}" required>
            @if ($errors->has('link'))
                <span class="invalid-feedback"><strong>{{ $errors->first('link') }}</strong></span>
            @endif
        </div>


        <div class="form-group">
            <label for="time" class="col-form-label">Time</label>
            <select id="time" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}"
                    name="time">
                @foreach ($time_list as $time)
                    <option value="{{ $time }}">
                        {{ $time }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('time'))
                <span class="invalid-feedback"><strong>{{ $errors->first('time') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>

    </form>
@endsection