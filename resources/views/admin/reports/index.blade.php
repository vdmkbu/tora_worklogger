@extends('layouts.app')

@section('content')
    @include('admin._nav', ['page' => 'reports'])

    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reports.projects') }}">By projects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.reports.positions') }}">By positions</a>
        </li>

    </ul>
@endsection