@extends('layout')

@section('content')
<div class="container">
    <h1>Симптоми</h1>

    <!-- Add New Symptom Form -->
    <form method="post" action="{{ route('add-symptom') }}">
        @csrf
        <div class="form-group">
            <label for="symptomName">Назва симптома:</label>
            <input type="text" class="form-control" id="symptomName" name="symptomName" required>
        </div>
        <button type="submit" class="btn btn-primary">Додати симптом</button>
    </form>

    <hr>

    <!-- Existing Symptoms Table -->
    <h2>Існуючі симптоми</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Назва симптома</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($symptoms as $symptom)
            <tr>
                <td>{{ $symptom->name }}</td>
                <td>
                    <a href="{{ route('edit-symptom', ['id' => $symptom->id]) }}" class="btn btn-warning">Редагувати</a>
                    <a href="{{ route('delete-symptom', ['id' => $symptom->id]) }}" class="btn btn-danger" onclick="return confirm('Ви впевнені?')">Видалити</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
