@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Несправності</h1>
    <h2>Додати несправність</h2>
    <form method="post" action="{{ route('add-malfunction') }}">
        @csrf
        <div class="form-group">
            <label for="malfunctionName">Назва несправності</label>
            <input type="text" class="form-control" id="malfunctionName" name="malfunctionName" required>
        </div>
        <div class="form-group">
            <label for="malfunctionDescription">Опис несправності</label>
            <textarea class="form-control" id="malfunctionDescription" name="malfunctionDescription" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label for="symptoms">Оберіть Симптоми</label>
            <select multiple class="form-control" id="symptoms" name="symptoms[]">
                @foreach ($symptoms as $symptom)
                    <option value="{{ $symptom->id }}">{{ $symptom->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Додати несправність</button>
    </form>

    <h2 class="mt-4">Список несправностей</h2>
    <table class="table  table-striped">
        <thead>
            <tr>
                <th>Назва несправності</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($malfunctions as $malfunction)
            <tr>
                <td>{{ $malfunction->name }}</td>
                <td>
                    <a href="{{ route('edit-malfunction', $malfunction->id) }}" class="btn btn-warning">Редагувати</a>
                    <a href="{{ route('destroy-malfunction', $malfunction->id) }}" class="btn btn-danger" onclick="return confirm('Ви впевнені?')">Видалити</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
