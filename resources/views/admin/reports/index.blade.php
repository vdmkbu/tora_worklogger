@extends('layouts.app')

@section('content')
    @include('admin._nav', ['page' => 'reports'])

    @include('admin.reports._nav', ['report' => null])
@endsection