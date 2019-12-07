@extends('layouts.app')

@section('content')
    @foreach($users as $user)
        <p><a href="{{ route('log.show', $user->id)  }}">{{ $user->name }}</a></p>
    @endforeach
@endsection