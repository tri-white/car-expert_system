@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-5 text-center">Результат діагностики</h1>
    @if (empty($filteredMalfunctions))
        <div class="alert alert-success mt-4">
            <p>Не знайдено ніяких проблем з двигуном, згідно ваших відповідей. Можливо, зверніться за допомогою до спеціалістів.</p>
        </div>
    @else
        <div class="alert alert-danger mt-4">
            <p class="font-weight-bold">Можливі проблеми:</p>
            <ul>
                @foreach ($filteredMalfunctions as $malfunctionId)
                    @php
                        $malfunction = \App\Models\Malfunction::find($malfunctionId);
                        $malfunctionSymptoms = $malfunction->symptoms;
                    @endphp
                    <li class="mt-3">{{ $malfunction->name }}</li>
                    <p>{{ $malfunction->description }}</p>
                    <ul>
                        @foreach ($malfunctionSymptoms as $symptom)
                            <li>{{ $symptom->name }}</li>
                        @endforeach
                    </ul>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
