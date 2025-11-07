<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VárosNavigátor - @yield('title', 'Főoldal')</title>

    <link rel="stylesheet" href="{{ asset('css/app-style.css') }}">

    @stack('styles')
</head>
<body>

    <header>
        <nav>
    <div class="container">
        <a href="{{ route('fooldal') }}" class="logo">VárosNavigátor</a>
        
        <ul>
            @auth
                <li><a href="{{ route('adatbazis.index') }}" class="{{ request()->routeIs('adatbazis.index') ? 'active' : '' }}">Adatbázis</a></li> 
                <li><a href="#" class="">Diagram</a></li> 
                <li><a href="{{ route('kapcsolat.index') }}" class="{{ request()->routeIs('kapcsolat.index') ? 'active' : '' }}">Kapcsolat</a></li>
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('uzenetek.index') }}" class="{{ request()->routeIs('uzenetek.index') ? 'active' : '' }}">Üzenetek</a></li>

                @if(Auth::user()->role == 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Admin Főoldal</a></li>

                    <li><a href="{{ route('admin.varosok.index') }}" class="{{ request()->routeIs('admin.varosok.*') ? 'active' : '' }}">Városok Kezelése</a></li>
                @endif

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-link">Kijelentkezés</button>
                    </form>
                </li>
            
            @else
                <li><a href="{{ route('kapcsolat.index') }}" class="{{ request()->routeIs('kapcsolat.index') ? 'active' : '' }}">Kapcsolat</a></li>
                <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Bejelentkezés</a></li>
                <li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Regisztráció</a></li>
            @endauth
        </ul>
    </div>
</nav>
    </header>

    <main>
        <div class="container">
            <div class="content-card">
                @yield('content')
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} VárosNavigátor. Minden jog fenntartva.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>