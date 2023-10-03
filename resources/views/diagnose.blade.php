@extends('layout')

@section('content')
<div class="container text-center">
    <form method="post" action="{{ route('diagnose') }}">
        @csrf
        <p class="my-3 fs-5 font-weight-light">Чи помічали ви наступний симптом:</p>
        <p class="my-0 mb-4 h3">{{ $symptom->name }}</p>
        <input type="hidden" name="symptom_id" value="{{ $symptom->id }}">
        
        @foreach($malfunctions as $malfunction)
            <input type="hidden" name="malfunctions[]" value="{{ $malfunction }}">
        @endforeach
        
        @foreach($askedSymptoms as $askedSymptom)
            <input type="hidden" name="askedSymptoms[]" value="{{ $askedSymptom }}">
        @endforeach

        <div class="mt-4">
            <label class="h6">
                <input type="radio" name="answer" value="yes"> Так
            </label><br>
            <label class="h6">
                <input type="radio" name="answer" value="no"> Ні
            </label><br>
            <label class="h6">
                <input type="radio" name="answer" value="unknown"> Не знаю
            </label><br>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Далі</button>
    </form>
</div>
@endsection
