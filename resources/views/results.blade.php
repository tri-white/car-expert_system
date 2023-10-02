
@extends('layouts')

@section('content')
<div class="container">
    <h1>Результат діагностики</h1>
    @if ($filteredMalfunctions->isEmpty())
        <p>Не знайдено ніяких проблем з двигуном, згідно ваших відповідей. Можливо, зверніться за допомогою до спеціалістів.</p>
    @else
        <p>Можливі проблеми:</p>
        <ul>
            @foreach ($filteredMalfunctions as $malfunction)
                <li>{{ $malfunction->name }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
