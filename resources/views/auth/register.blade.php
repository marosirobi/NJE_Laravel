@extends('layouts.main')

@section('title', 'Regisztráció')

@section('content')
    <h2>Regisztráció</h2>

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

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="field">
            <label for="name">Név</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div class="field">
            <label for="password">Jelszó</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="field">
            <label for="password_confirmation">Jelszó megerősítése</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('login') }}">Már regisztráltál?</a>
            <button type="submit" class="button">Regisztráció</button>
        </div>
    </form>
@endsection