@extends('layout')

@section('content')
<div class="container">
    <h1>Діагностика автомобіля</h1>
    <a href="{{ route('symptoms') }}" class="btn btn-primary">Симптом</a>
    <a href="{{ route('malfunctions') }}" class="btn btn-success">Несправності</a>
</div>
@endsection