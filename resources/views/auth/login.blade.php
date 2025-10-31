@extends('layouts.main')

@section('title', 'Bejelentkezés')

@section('content')
    <h2>Bejelentkezés</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Hoppá!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="field">
            <label for="password">Jelszó</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="field">
            <label for="remember_me">
                <input type="checkbox" id="remember_me" name="remember" style="width: auto; margin-right: 8px;">
                Emlékezz rám
            </label>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Elfelejtetted a jelszavad?</a>
            @endif
            <button type="submit" class="button">Bejelentkezés</button>
        </div>
    </form>
@endsection