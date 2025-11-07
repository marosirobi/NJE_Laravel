@extends('layouts.main')

@section('title', 'Város Adatbázis')

@section('content')
    
    <h2>Városok Adatbázisa</h2>
    <p>Böngéssz az adatbázisban, vagy használj szűrőket a keresés pontosításához.</p>

    <form method="GET" action="{{ route('adatbazis.index') }}" class="filter-form">
        
        <div class="field">
            <label for="megye">Megyére szűrés:</label>
            <select name="megye" id="megye">
                <option value="">Összes megye</option>
                @foreach ($megyek as $megye)
                    <option value="{{ $megye->id }}"
                        {{-- Ez a rész "emlékszik" a kiválasztott értékre --}}
                        {{ request('megye') == $megye->id ? 'selected' : '' }}>
                        {{ $megye->nev }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="field">
            <label for="varos">Város névre szűrés (részlet):</label>
            <input type="text" name="varos" id="varos" value="{{ request('varos') }}">
        </div>

        <div class="field-buttons">
            <button type="submit" class="button">Szűrés</button>
            <a href="{{ route('adatbazis.index') }}" class="button button-secondary">Törlés</a>
        </div>
    </form>
    @if($varosok->isEmpty())
        <h3 style="margin-top: 2rem;">Nincs találat</h3>
        <p>A megadott szűrési feltételekkel nem található város az adatbázisban.</p>

    @else
        <h3 style="margin-top: 2rem;">Találatok ({{ $varosok->count() }} db)</h3>

        @foreach ($varosok as $varos)
            
            <h4 style="margin-top: 2rem; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
                {{ $varos->nev }} ({{ $varos->megye->nev }})
            </h4>
            
            <p>
                <strong>Megyeszékhely:</strong> {{ $varos->megyeszekhely ? 'Igen' : 'Nem' }}
                <br>
                <strong>Megyei jogú:</strong> {{ $varos->megyeijogu ? 'Igen' : 'Nem' }}
            </p>

            <h5>Lélekszám Adatok:</h5>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Év</th>
                            <th>Nők száma</th>
                            <th>Összesen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($varos->lelekszamok as $lelekszam)
                            <tr>
                                <td>{{ $lelekszam->ev }}</td>
                                <td>{{ number_format($lelekszam->no, 0, ',', ' ') }} fő</td>
                                <td>{{ number_format($lelekszam->osszesen, 0, ',', ' ') }} fő</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center;">Ehhez a városhoz nincs rögzített lélekszám adat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        @endforeach
    @endif

@endsection