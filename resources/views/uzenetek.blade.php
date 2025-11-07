@extends('layouts.main')

@section('title', 'Beérkezett Üzenetek')

@section('content')

    <h2>Üzenetek</h2>
    <p>Itt láthatod a "Kapcsolat" űrlapon keresztül beküldött üzeneteket.</p>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Küldő</th>
                    <th>Email</th>
                    <th>Üzenet</th>
                    <th>Küldés ideje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($uzenete as $uzenet)
                    <tr>
                        <td>{{ $uzenet->nev }}</td>
                        <td>{{ $uzenet->email }}</td>
                        <td>{{ $uzenet->uzenet }}</td>
                        <td>{{ $uzenet->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Még nincsenek üzenetek.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection