@extends('layout')

@section('content')
<div class="container">
    <h1>Результат діагностики</h1>
    @if (empty($filteredMalfunctions))
        <p>Не знайдено ніяких проблем з двигуном, згідно ваших відповідей. Можливо, зверніться за допомогою до спеціалістів.</p>
    @else
        <p>Можливі проблеми:</p>
        <ul>
            @foreach ($filteredMalfunctions as $malfunctionId)
                @php
                    $malfunction = \App\Models\Malfunction::find($malfunctionId);
                @endphp
                <li>{{ $malfunction->name }}</li>
                <p>{{ $malfunction->description }}</p>
            @endforeach
        </ul>
    @endif
</div>
@endsection
