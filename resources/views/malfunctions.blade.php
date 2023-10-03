@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Додати нову несправність</h1>

    <form method="POST" action="{{ route('malfunctions.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Назва несправності</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Опис несправності</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="symptoms">Оберіть симптоми</label>
            <select name="symptoms[]" id="symptoms" class="form-control" multiple required>
                @foreach($symptoms as $symptom)
                    <option value="{{ $symptom->id }}">{{ $symptom->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Додати несправність</button>
    </form>
</div>
@endsection
