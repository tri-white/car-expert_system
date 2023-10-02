@extends('layout')

@section('content')
<div class="container">
    <h1>Діагностика автомобіля</h1>
    <form method="post" action="{{ route('diagnose') }}">
        @csrf
        <p>Чи помічали ви наступне:</p>
        <p>"{{ $symptom->name }}"</p>
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
