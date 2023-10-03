@extends('layout')

@section('content')
<div class="container">
    <h1 class="text-center">Редагування симптому</h1>
    <form method="POST" action="{{ route('update-symptom', ['id' => $symptom->id]) }}">
        @csrf

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

        <button type="submit" class="mt-2 btn btn-primary">Зберегти зміни</button>
    </form>
</div>
@endsection
