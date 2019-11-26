@extends('layouts.app')

@section('content')
    @include('admin._nav', ['page' => 'users'])

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')

        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $user->name) }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="col-form-label">E-Mail Address</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email) }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="position" class="col-form-label">Position</label>
            <select id="position" class="form-control{{ $errors->has('position_id') ? ' is-invalid' : '' }}"
            name="position_id">
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}"
                            {{ $position->id === old('position_id', $user->position->id) ? ' selected' : '' }}
                            {{ $position->isDisabled() ? ' disabled':'' }}
                    >
                        {{ $position->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('position_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('position_id') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select id="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role">
                @foreach ($roles as $value => $label)
                    <option value="{{ $value }}"{{ $value === old('role', $user->role) ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach;
            </select>
            @if ($errors->has('role'))
                <span class="invalid-feedback"><strong>{{ $errors->first('role') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
@endsection