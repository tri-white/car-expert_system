@extends('layout')

@section('content')
<div class="container">
<a href="{{ route('welcome') }}">
        <h1>Діагностика автомобіля</h1>
    </a>
    <form method="post" action="{{ route('diagnose') }}">
        @csrf
        <p>Чи помічали ви наступний симптом:</p>
        <p>{{ $symptom->name }}</p>
        <input type="hidden" name="symptom_id" value="{{ $symptom->id }}">
        <label>
            <input type="radio" name="answer" value="yes"> Так
        </label><br>
        <label>
            <input type="radio" name="answer" value="no"> Ні
        </label><br>
        <label>
            <input type="radio" name="answer" value="unknown"> Не знаю
        </label><br>
        <button type="submit" class="button-primary">Next</button>
    </form>
</div>
@endsection
