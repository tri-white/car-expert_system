@extends('layout')

@section('content')
<div class="container">
    <h1 class="text-center">Редагування несправності</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="post" action="{{ route('update-malfunction', ['id' => $malfunction->id]) }}">
        @csrf
        <div class="form-group">
            <label for="malfunctionName">Назва несправності</label>
            <input type="text" class="form-control" id="malfunctionName" name="malfunctionName" value="{{ $malfunction->name }}" required>
        </div>
        <div class="form-group">
            <label for="malfunctionDescription">Опис несправності</label>
            <textarea class="form-control" id="malfunctionDescription" name="malfunctionDescription" rows="4">{{ $malfunction->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="symptoms">Оберіть Симптоми</label>
            <select multiple class="form-control" id="symptoms" name="symptoms[]">
                @foreach ($symptoms as $symptom)
                    <option value="{{ $symptom->id }}" @if(in_array($symptom->id, $malfunction->symptoms->pluck('id')->toArray())) selected @endif>{{ $symptom->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="mt-2 btn btn-primary">Зберегти зміни</button>
    </form>
</div>
@endsection
