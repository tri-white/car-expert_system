
@extends('layout')

@section('content')
<div class="container">
    <h1>Вітаємо в експертній системі з діагностики автомобіля"</h1>
    <div class="options">
        <a href="{{ route('diagnose') }}" class="btn btn-primary">Пройти діагностику</a><br>
        <a href="{{ route('configure') }}" class="btn btn-secondary">Конфігурація експертної системи</a>
    </div>
</div>
@endsection
