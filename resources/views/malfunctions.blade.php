@extends('layout')

@section('content')
<div class="container">
    <h1>Малфункції</h1>

    <!-- Display success messages if any -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Malfunction Form -->
    <h2>Додати Малфункцію</h2>
    <form method="post" action="{{ route('malfunctions.store') }}">
        @csrf
        <div class="form-group">
            <label for="malfunctionName">Назва Малфункції</label>
            <input type="text" class="form-control" id="malfunctionName" name="malfunctionName" required>
        </div>
        <div class="form-group">
            <label for="symptoms">Оберіть Симптоми</label>
            <select multiple class="form-control" id="symptoms" name="symptoms[]">
                @foreach ($symptoms as $symptom)
                    <option value="{{ $symptom->id }}">{{ $symptom->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Додати Малфункцію</button>
    </form>

    <!-- List of Malfunctions -->
    <h2>Список Малфункцій</h2>
    <ul>
        @foreach ($malfunctions as $malfunction)
            <li>
                {{ $malfunction->name }}
                <a href="{{ route('malfunctions.edit', $malfunction->id) }}" class="btn btn-sm btn-warning">Редагувати</a>
                <a href="{{ route('malfunctions.destroy', $malfunction->id) }}" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $malfunction->id }}').submit();">Видалити</a>
                <form id="delete-form-{{ $malfunction->id }}" action="{{ route('malfunctions.destroy', $malfunction->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
