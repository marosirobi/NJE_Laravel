@extends('layouts.main')
@section('title', 'Főoldal')

@section('content')
<style>
:root{ --c1:#0ea5e9; --c2:#22c55e; --ink:#0f172a; --muted:#64748b; }
.fh-container{max-width:1140px;margin:0 auto;padding:24px;}
.hero{
  position:relative; min-height:60vh; display:flex; align-items:center; border-radius:20px; overflow:hidden;
  background:linear-gradient(180deg,rgba(0,0,0,.15),rgba(0,0,0,.55)),
              url('https://images.unsplash.com/photo-1505764706515-aa95265c5abc?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
  color:#fff;
}
.hero-inner{position:relative; z-index:2; padding:40px; max-width:900px;}
.hero h1{font-size:46px; line-height:1.1; margin:0 0 14px; font-weight:800;color:white}
.hero p{font-size:18px; opacity:.95; margin:0 0 18px; max-width:840px;}
.btn{display:inline-block; padding:12px 18px; border-radius:999px; text-decoration:none; font-weight:700; color:#fff; transition:.2s;}
.btn.primary{background:var(--c2);} .btn.secondary{background:var(--c1);} .btn:hover{transform:translateY(-1px); opacity:.95;}
.section{margin-top:40px;} .section h2{font-size:28px; margin-bottom:12px; color:var(--ink)} .muted{color:var(--muted)}
.grid{display:grid; gap:16px;}
.cards{grid-template-columns:repeat(auto-fit,minmax(240px,1fr));}
.card{background:#fff; border-radius:16px; padding:18px; box-shadow:0 10px 30px rgba(15,23,42,.08);}
.card h3{margin:0 0 6px; font-size:18px; color:var(--ink)} .card p{margin:0; color:var(--muted)}
.steps{grid-template-columns:repeat(auto-fit,minmax(220px,1fr));}
.step{background:#fff; border-radius:16px; padding:18px; box-shadow:0 10px 30px rgba(15,23,42,.08);}
.quote{background:#fff; border-left:6px solid var(--c1); border-radius:14px; padding:18px;}
.footer-cta{
  background:linear-gradient(120deg,var(--c1),var(--c2)); color:#fff;
  border-radius:18px; padding:24px; display:flex; gap:14px; align-items:center; justify-content:space-between; flex-wrap:wrap;
}
.badges{display:flex; gap:12px; flex-wrap:wrap;}
.badge{background:#e2e8f0; color:#0f172a; border-radius:999px; padding:6px 10px; font-size:12px; font-weight:700;}
@media (max-width:640px){ .hero h1{font-size:34px} }
</style>

<div class="fh-container">

  {{-- HERO --}}
  <section class="hero">
    <div class="hero-inner">
      <div class="badges">
        <span class="badge">Magyar városok</span>
        <span class="badge">Lélekszám idősorok</span>
        <span class="badge">Adatvizualizáció</span>
      </div>
      <h1>VárosNavigátor – magyar városok adatai egy helyen</h1>
      <p>A VárosNavigátor egy fiktív magyar platform, amely részletes statisztikai és turisztikai információkat gyűjt a hazai városokról. Célunk, hogy utazók, befektetők és önkormányzatok gyorsan átlássák a lélekszám-trendeket és a fontos mutatókat.</p>
      <p>Oldalunkon böngészhet a városok adatbázisában, készíthet látványos diagramokat, és felveheti velünk a kapcsolatot új adatigényekkel.</p>
      <div style="display:flex;gap:12px;flex-wrap:wrap;">
        @if (Route::has('adatbazis.index'))
          <a class="btn primary" href="{{ route('adatbazis.index') }}">Adatbázis megtekintése</a>
        @else
          <a class="btn primary" href="{{ url('/adatbazis') }}">Adatbázis megtekintése</a>
        @endif
        @if (Route::has('diagram.index'))
          <a class="btn secondary" href="{{ route('diagram.index') }}">Lakossági diagramok</a>
        @endif
        @if (Route::has('kapcsolat.index'))
          <a class="btn secondary" href="{{ route('kapcsolat.index') }}">Kapcsolat</a>
        @endif
      </div>
    </div>
  </section>

  {{-- Értékajánlat --}}
  <section class="section">
    <h2>Mit tud a VárosNavigátor?</h2>
    <div class="grid cards">
      <div class="card">
        <h3>Teljes település-adatbázis</h3>
        <p>Városok megyéhez rendelve, több évre visszamenő lélekszám-adatokkal és alapvető meta-információkkal.</p>
      </div>
      <div class="card">
        <h3>Idősorok és összehasonlítás</h3>
        <p>Évről évre követhető változás, top-listák és gyors összevetés városok között.</p>
      </div>
      <div class="card">
        <h3>Látványos diagramok</h3>
        <p>Chart.js segítségével pár kattintással áttekinthető grafikonok készülnek bemutatókhoz is.</p>
      </div>
      <div class="card">
        <h3>Visszajelzés & adatigény</h3>
        <p>Hiányzik egy mutató? Írjon nekünk, és felvesszük a bővítési javaslatok közé.</p>
      </div>
    </div>
  </section>

  {{-- Kinek szól? --}}
  <section class="section">
    <h2>Kinek hasznos?</h2>
    <div class="grid cards">
      <div class="card">
        <h3>Utazóknak</h3>
        <p>Ismerje meg a célvárosok nagyságát és környezetét, hogy jobban tervezzen utazás előtt.</p>
      </div>
      <div class="card">
        <h3>Befektetőknek</h3>
        <p>Népességi trendek és megyei kontextus – gyors helyzetkép döntés-előkészítéshez.</p>
      </div>
      <div class="card">
        <h3>Önkormányzatoknak & kutatóknak</h3>
        <p>Gyors adatelérés, diagramok prezentációkhoz és pályázatokhoz.</p>
      </div>
    </div>
  </section>

  {{-- Hogyan működik? --}}
  <section class="section">
    <h2>Hogyan működik?</h2>
    <div class="grid steps">
      <div class="step"><strong>1. Böngéssz</strong><br>Nyisd meg az adatbázist, és keress városra vagy megyére.</div>
      <div class="step"><strong>2. Hasonlíts</strong><br>Nézd meg az évek közötti különbségeket és a top városokat.</div>
      <div class="step"><strong>3. Vizualizálj</strong><br>Készíts oszlopdiagramot a kiválasztott nézetből, és használd prezentációban.</div>
    </div>
  </section>

  {{-- Számokban – EGYETLEN szekció, automatikus táblanév-felismeréssel --}}
  @php
    // 1) táblanevek kilistázása driverenként
    $driver = \Illuminate\Support\Facades\DB::getDriverName();
    $tableNames = [];
    try {
        if ($driver === 'mysql') {
            $rows = \Illuminate\Support\Facades\DB::select("SELECT table_name AS name FROM information_schema.tables WHERE table_schema = DATABASE()");
            foreach ($rows as $r) { $tableNames[] = strtolower((array)$r['name'] ?? ($r->name ?? '')); }
        } elseif ($driver === 'sqlite') {
            $rows = \Illuminate\Support\Facades\DB::select("SELECT name FROM sqlite_master WHERE type='table'");
            foreach ($rows as $r) { $tableNames[] = strtolower((array)$r['name'] ?? ($r->name ?? '')); }
        } elseif ($driver === 'pgsql') {
            $rows = \Illuminate\Support\Facades\DB::select("SELECT tablename AS name FROM pg_catalog.pg_tables WHERE schemaname IN (SELECT unnest(current_schemas(false)))");
            foreach ($rows as $r) { $tableNames[] = strtolower((array)$r['name'] ?? ($r->name ?? '')); }
        }
    } catch (\Throwable $e) { $tableNames = []; }

    // 2) kereső segédfüggvény: első olyan tábla, aminek neve tartalmazza bármelyik mintát
    $findFirstLike = function(array $patterns) use ($tableNames) {
        foreach ($tableNames as $t) {
            foreach ($patterns as $p) {
                if (strpos($t, strtolower($p)) !== false) return $t;
            }
        }
        return null;
    };

    // 3) megtippelt táblák
    $cityTable = 'varosok';
    $popTable  = 'lelekszam';
    $userTable = 'users';

    // 4) számlálás (ha nincs találat, 0)
    $safeCount = function(?string $table) {
        if (!$table) return 0;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable($table)) {
                return (int) \Illuminate\Support\Facades\DB::table($table)->count();
            }
        } catch (\Throwable $e) {}
        return 0;
    };

    $varosCount     = $safeCount($cityTable);
    $lelekszamCount = $safeCount($popTable);
    $usersCount     = $safeCount($userTable);
  @endphp

  <section class="section">
    <h2>Számokban</h2>
    <div class="grid cards">
      <div class="card"><h3>{{ number_format($varosCount) }}</h3><p class="muted">város a rendszerben</p></div>
      <div class="card"><h3>{{ number_format($lelekszamCount) }}</h3><p class="muted">lélekszám-rekord</p></div>
      <div class="card"><h3>{{ number_format($usersCount) }}</h3><p class="muted">regisztrált felhasználó</p></div>
    </div>
  </section>

  {{-- Záró CTA --}}
  <section class="section">
    <div class="footer-cta">
      <div>
        <h3 style="margin:0 0 6px;">Felfedeznéd a saját városodat is?</h3>
        <div class="">Kezdd az adatbázissal, vagy írj nekünk adatigényről.</div>
      </div>
      <div style="display:flex; gap:10px; flex-wrap:wrap;">
        @if (Route::has('adatbazis.index'))
          <a class="btn secondary" href="{{ route('adatbazis.index') }}">Adatbázis megnyitása</a>
        @endif
        @if (Route::has('kapcsolat.index'))
          <a class="btn primary" href="{{ route('kapcsolat.index') }}">Kapcsolatfelvétel</a>
        @endif
      </div>
    </div>
  </section>

</div>
@endsection
