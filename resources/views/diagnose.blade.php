
@extends('layout')

@section('content')
<div class="container">
    <h1>Vehicle Symptom Diagnosis</h1>
    <form method="post" action="{{ route('diagnose') }}">
        @csrf
        <p>Do you have the following symptom:</p>
        <p>"{{ $randomSymptom }}"</p>
        <input type="hidden" name="symptom_id" value="{{ $symptomId }}">
        <label>
            <input type="radio" name="answer" value="yes"> Yes
        </label>
        <label>
            <input type="radio" name="answer" value="no"> No
        </label>
        <label>
            <input type="radio" name="answer" value="unknown"> I don't know
        </label>
        <button type="submit">Next</button>
    </form>
</div>
@endsection
