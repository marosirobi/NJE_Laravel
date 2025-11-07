@extends('layouts.main')

@section('title', 'Városok Kezelése')

@section('content')
    <h2>Városok Kezelése (CRUD)</h2>
    <form method="GET" action="{{ route('admin.varosok.index') }}" class="filter-form">

    <div class="field">
        <label for="megye">Megyére szűrés:</label>
        <select name="megye" id="megye">
            <option value="">Összes megye</option>
            @foreach ($megyek as $megye)
                <option value="{{ $megye->id }}" {{ request('megye') == $megye->id ? 'selected' : '' }}>
                    {{ $megye->nev }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label for="varos">Város névre szűrés:</label>
        <input type="text" name="varos" id="varos" value="{{ request('varos') }}">
    </div>

    <div class="field-buttons">
        <button type="submit" class="button">Szűrés</button>
        <a href="{{ route('admin.varosok.index') }}" class="button button-secondary">Törlés</a>
    </div>
</form>
    <p>Itt hozhatsz létre új városokat, vagy szerkesztheted a meglévőket.</p>

    <a href="{{ route('admin.varosok.create') }}" class="button" style="margin-bottom: 1.5rem;">Új Város Létrehozása</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Megye</th>
                    <th>Megyeszékhely</th>
                    <th>Megyei jogú</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($varosok as $varos)
                    <tr>
                        <td>{{ $varos->id }}</td>
                        <td>{{ $varos->nev }}</td>
                        <td>{{ $varos->megye->nev }}</td>
                        <td>{{ $varos->megyeszekhely ? 'Igen' : 'Nem' }}</td>
                        <td>{{ $varos->megyeijogu ? 'Igen' : 'Nem' }}</td>
                        <td>
                            <a href="{{ route('admin.varosok.edit', $varos) }}" class="button" style="background-color: #ffc107; font-size: 0.8rem; padding: 0.4rem 0.8rem;">Szerkesztés</a>
                            
                            <form action="{{ route('admin.varosok.destroy', $varos) }}" method="POST" style="display: inline-block; margin-left: 5px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button" 
                                        style="background-color: #dc3545; font-size: 0.8rem; padding: 0.4rem 0.8rem;"
                                        onclick="return confirm('Biztosan törölni szeretnéd ezt a várost: {{ $varos->nev }}?')">
                                    Törlés
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">Még nincsenek városok az adatbázisban.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $varosok->appends(request()->query())->links() }}
    </div>

@endsection