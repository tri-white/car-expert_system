
@extends('layout')

@section('content')
<div class="container">
    <h1>Діагностика автомобіля</h1>
    <form method="post" action="{{ route('diagnose') }}">
        @csrf
        <p>Чи помічали ви наступне:</p>
        <p>"{{ $randomSymptom }}"</p>
        <input type="hidden" name="symptom_id" value="{{ $symptomId }}">
        <label>
            <input type="radio" name="answer" value="yes"> Так
        </label>
        <label>
            <input type="radio" name="answer" value="no"> Ні
        </label>
        <label>
            <input type="radio" name="answer" value="unknown"> Не знаю
        </label>
        <button type="submit">Next</button>
    </form>
</div>
@endsection
