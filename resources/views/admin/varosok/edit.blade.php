@extends('layouts.main')

@section('title', 'Város Szerkesztése: ' . $varos->nev)

@section('content')

    <h2>Város Szerkesztése: {{ $varos->nev }}</h2>
    <form action="{{ route('admin.varosok.update', $varos) }}" method="POST">
        @method('PUT') @include('admin.varosok._form')
    </form>

    <hr style="margin-top: 3rem; margin-bottom: 3rem; border: 1px solid #007bff;">

    <h2>Lélekszám Adatok ({{ $varos->nev }})</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Hoppá! Hiba történt.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h3>Meglévő adatok</h3>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Év</th>
                    <th>Nők száma</th>
                    <th>Összesen</th>
                    <th>Művelet</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($varos->lelekszamok as $lelekszam)
                    <tr>
                        <td>{{ $lelekszam->ev }}</td>
                        <td>{{ number_format($lelekszam->no) }} fő</td>
                        <td>{{ number_format($lelekszam->osszesen) }} fő</td>
                        <td>
                            <form action="{{ route('admin.lelekszam.destroy', ['varosid' => $lelekszam->varosid, 'ev' => $lelekszam->ev]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type"submit" class="button" 
                                        style="background-color: #dc3545; font-size: 0.8rem; padding: 0.4rem 0.8rem;"
                                        onclick="return confirm('Biztosan törlöd a(z) {{ $lelekszam->ev }} évi adatot?')">
                                    Törlés
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Ehhez a városhoz még nincs lélekszám adat rögzítve.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h3 style="margin-top: 2rem;">Új adat hozzáadása</h3>
    <form action="{{ route('admin.varosok.lelekszam.store', $varos) }}" method="POST" class="filter-form">
        @csrf
        <div class="field">
            <label for="ev">Év</label>
            <input type="number" name="ev" id="ev" value="{{ old('ev') }}" placeholder="pl. 2023" required>
        </div>
        <div class="field">
            <label for="no">Nők száma</label>
            <input type="number" name="no" id="no" value="{{ old('no') }}" required>
        </div>
        <div class="field">
            <label for="osszesen">Összesen</label>
            <input type="number" name="osszesen" id="osszesen" value="{{ old('osszesen') }}" required>
        </div>
        <div class="field-buttons">
            <button type="submit" class="button">Mentés</button>
        </div>
    </form>

@endsection