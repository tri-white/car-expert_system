@extends('layout')

@section('content')
<div class="container text-center mt-5">
    <h1 class="mb-4">Виберіть опцію:</h1>
    <a href="{{ route('symptoms') }}" class="btn btn-primary btn-lg mb-3">Налаштування симптомів</a><br>
    <a href="{{ route('malfunctions') }}" class="btn btn-success btn-lg mb-3">Налаштування несправностей</a>
</div>
@endsection
