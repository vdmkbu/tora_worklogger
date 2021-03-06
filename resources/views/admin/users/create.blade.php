@extends('layouts.app')

@section('content')
    @include('admin._nav', ['page' => 'users'])

    <form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="col-form-label">E-Mail Address</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="position_id" class="col-form-label">Position</label>
            <select id="position_id" class="form-control{{ $errors->has('position_id') ? ' is-invalid' : '' }}"
                    name="position_id">
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">
                        {{ $position->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('position_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('position_id') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label">Password</label>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection