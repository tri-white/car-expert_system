
@extends('layout')

@section('content')
<div class="container">
    <h1>Welcome to the Vehicle Diagnostic Expert System</h1>
    <div class="options">
        <a href="{{ route('diagnose') }}" class="btn btn-primary">Diagnose Car</a>
        <a href="{{ route('configure') }}" class="btn btn-secondary">Configure Expert System</a>
    </div>
</div>
@endsection
