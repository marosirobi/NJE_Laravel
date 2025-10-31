@extends('layouts.main')

@section('title', 'Kapcsolat')

@section('content')

    <h2>Kapcsolat</h2>
    <p>Kérjen tőlünk adatot, vagy jelezzen hibát az űrlap segítségével!</p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Hoppá! Valami hiba történt.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('kapcsolat.store') }}">
        @csrf
        <div class="field">
            <label for="nev">Név</label>
            <input type="text" name="nev" id="nev" value="{{ old('nev') }}" required>
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div class="field">
            <label for="uzenet">Üzenet</label>
            <textarea name="uzenet" id="uzenet" required>{{ old('uzenet') }}</textarea>
        </div>

        <div>
            <button type="submit" class="button">Üzenet küldése</button>
        </div>
    </form>

@endsection