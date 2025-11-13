@extends('layouts.main')
@section('title', 'Főoldal')

@section('content')
<style>
/* --- Oldalspecifikus, egyszerű, reszponzív stílus --- */
:root{
  --c1:#0ea5e9; --c2:#22c55e; --ink:#0f172a; --muted:#64748b; --bg:#f8fafc;
}
.fh-container{max-width:1140px;margin:0 auto;padding:24px;}
.hero{
  position:relative; min-height:62vh; display:flex; align-items:center; border-radius:20px; overflow:hidden;
  background:linear-gradient(180deg,rgba(0,0,0,.15),rgba(0,0,0,.55)),
              url('https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat;
  color:#fff;
}
.hero-inner{position:relative; z-index:2; padding:40px; max-width:900px;}
.hero h1{font-size:46px; line-height:1.1; margin:0 0 14px; font-weight:800;}
.hero p{font-size:18px; opacity:.95; margin:0 0 18px; max-width:840px;}
.btn{display:inline-block; padding:12px 18px; border-radius:999px; text-decoration:none; font-weight:700; color:#fff; transition:.2s;}
.btn.primary{background:var(--c2);}
.btn.secondary{background:var(--c1);}
.btn:hover{transform:translateY(-1px); opacity:.95;}

.section{margin-top:40px;}
.section h2{font-size:28px; margin-bottom:12px; color:var(--ink)}
.muted{color:var(--muted);}

.grid{display:grid; gap:16px;}
.cards{grid-template-columns:repeat(auto-fit,minmax(240px,1fr));}
.card{background:#fff; border-radius:16px; padding:18px; box-shadow:0 10px 30px rgba(15,23,42,.08);}
.card h3{margin:0 0 6px; font-size:18px; color:var(--ink)}
.card p{margin:0; color:var(--muted)}

.stats{grid-template-columns:repeat(auto-fit,minmax(200px,1fr));}
.stat{background:#0f172a; color:#fff; border-radius:16px; padding:20px; text-align:center;}
.stat .num{font-size:36px; font-weight:900; letter-spacing:.5px;}
.stat .label{opacity:.9}

.services{grid-template-columns:repeat(auto-fit,minmax(280px,1fr));}
.service{background:linear-gradient(180deg,#fff,#f1f5f9); border:1px solid #e2e8f0;
  border-radius:16px; padding:18px;}
.service ul{margin:10px 0 0 18px; color:var(--muted)}

.quote{background:#fff; border-left:6px solid var(--c1); border-radius:14px; padding:18px;}
.footer-cta{
  background:linear-gradient(120deg,var(--c1),var(--c2)); color:#fff;
  border-radius:18px; padding:24px; display:flex; gap:14px; align-items:center; justify-content:space-between; flex-wrap:wrap;
}
.badges{display:flex; gap:12px; flex-wrap:wrap;}
.badge{background:#e2e8f0; color:#0f172a; border-radius:999px; padding:6px 10px; font-size:12px; font-weight:700;}
@media (max-width:640px){
  .hero h1{font-size:34px}
}
</style>

<div class="fh-container">

  {{-- HERO --}}
  <section class="hero">
    <div class="hero-inner">
      <div class="badges">
        <span class="badge">Laravel alap</span>
        <span class="badge">Reszponzív</span>
        <span class="badge">Biztonság</span>
      </div>
      <h1>Látványos, gyors és üzembiztos vállalati megoldások</h1>
      <p>Modern webes rendszereket készítünk: tiszta architektúra, stabil adatbázis,
         és felhasználóbarát felület – a Laravel erejével.</p>
      <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a class="btn primary" href="{{ route('diagram.index') }}">Nézd meg a diagramot</a>
        <a class="btn secondary" href="{{ url('/kapcsolat') }}">Kérjen ajánlatot</a>
      </div>
    </div>
  </section>

  {{-- ELŐNYÖK --}}
  <section class="section">
    <h2>Miért válasszon minket?</h2>
    <p class="muted">A legfontosabb értékeink, amelyekre a teljes fejlesztési folyamatot építjük.</p>
    <div class="grid cards">
      <div class="card">
        <h3>Gyors fejlesztés</h3>
        <p>Agilis folyamatok, rövid átfutási idő és átlátható mérföldkövek.</p>
      </div>
      <div class="card">
        <h3>Skálázható rendszer</h3>
        <p>Tiszta kódbázis, moduláris felépítés, hosszú távú fenntarthatóság.</p>
      </div>
      <div class="card">
        <h3>Valódi biztonság</h3>
        <p>Beépített autentikáció, jogosultságkezelés és validáció minden űrlapon.</p>
      </div>
      <div class="card">
        <h3>Üzemeltetés & támogatás</h3>
        <p>Monitoring, frissítések, SLA opciók és gyors hibajavítás.</p>
      </div>
    </div>
  </section>

  {{-- STATISZTIKÁK (animált számláló, fix értékekkel is jól néz ki) --}}
  <section class="section">
    <h2>Számokban</h2>
    <div class="grid stats">
      <div class="stat">
        <div class="num" data-count="1200">0</div>
        <div class="label">Élesített modul</div>
      </div>
      <div class="stat">
        <div class="num" data-count="99">0</div>
        <div class="label">Ügyfélelégedettség (%)</div>
      </div>
      <div class="stat">
        <div class="num" data-count="24">0</div>
        <div class="label">Órás támogatás</div>
      </div>
    </div>
  </section>

  {{-- SZOLGÁLTATÁSOK --}}
  <section class="section">
    <h2>Szolgáltatásaink</h2>
    <div class="grid services">
      <div class="service">
        <h3>Webalkalmazás fejlesztés</h3>
        <ul>
          <li>Laravel REST/CRUD</li>
          <li>Reszponzív felület</li>
          <li>Integrációk (API, e-mail, PDF)</li>
        </ul>
      </div>
      <div class="service">
        <h3>Adatbázis & riport</h3>
        <ul>
          <li>Migrációk, seedek</li>
          <li>Validált űrlapok</li>
          <li>Chart.js diagramok</li>
        </ul>
      </div>
      <div class="service">
        <h3>Üzemeltetés</h3>
        <ul>
          <li>Deploy tárhelyre</li>
          <li>Mentések, monitorozás</li>
          <li>Frissítések és SLA</li>
        </ul>
      </div>
    </div>
  </section>

  {{-- ÜGYFÉLVÉLEMÉNY --}}
  <section class="section">
    <h2>Ügyfeleink mondták</h2>
    <div class="quote">
      „Rugalmasság, tiszta kód és kiváló kommunikáció. Az új oldalunk gyors és
      látványos lett. Ajánlom!” — <strong>Kovács Anna, ügyvezető</strong>
    </div>
  </section>

  {{-- ZÁRÓ CTA --}}
  <section class="section">
    <div class="footer-cta">
      <div>
        <h3 style="margin:0 0 6px;">Kezdjük el a közös munkát!</h3>
        <div class="muted">Írjon nekünk, 1 munkanapon belül jelentkezünk.</div>
      </div>
      <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <a class="btn secondary" href="{{ url('/kapcsolat') }}">Kapcsolatfelvétel</a>
        <a class="btn primary" href="{{ route('diagram.index', [], false) }}">Mutasd a diagramot</a>
      </div>
    </div>
  </section>

</div>

{{-- Egyszerű számláló animáció --}}
<script>
(function(){
  const els = document.querySelectorAll('.num');
  const inView = (el) => {
    const r = el.getBoundingClientRect();
    return r.top < window.innerHeight && r.bottom > 0;
  };
  const animate = el => {
    const target = +el.dataset.count || 0;
    const start = performance.now();
    const dur = 1200;
    function tick(t){
      const p = Math.min(1, (t - start)/dur);
      el.textContent = Math.floor(target * p).toLocaleString('hu-HU');
      if(p<1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
    el.dataset.done = '1';
  };
  const onScroll = () => els.forEach(el => {
    if(!el.dataset.done && inView(el)) animate(el);
  });
  window.addEventListener('scroll', onScroll, {passive:true});
  onScroll();
})();
</script>
@endsection
