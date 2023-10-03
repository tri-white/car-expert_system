@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редагування симптому</h1>
    <form method="POST" action="{{ route('update-symptom', ['id' => $symptom->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="symptomName">Назва симптому</label>
            <input type="text" class="form-control" id="symptomName" name="symptomName" value="{{ $symptom->name }}">
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Зберегти зміни</button>
    </form>
</div>
@endsection
