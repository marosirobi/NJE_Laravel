@extends('layouts.main')
@section('title', 'Diagram')

@section('content')
  <h2>Felhasználói regisztrációk – {{ $year }}</h2>
  <p>Az alábbi oszlopdiagram a regisztrált felhasználók számát mutatja hónapokra bontva az adott évben.</p>

  <form method="GET" action="{{ route('diagram.index') }}" style="margin: 12px 0 20px;">
      <label for="year">Év:&nbsp;</label>
      <select name="year" id="year" onchange="this.form.submit()">
          @foreach ($years as $y)
              <option value="{{ $y }}" {{ (int)$y === (int)$year ? 'selected' : '' }}>{{ $y }}</option>
          @endforeach
      </select>
  </form>

  <div style="max-width: 1000px;">
      <canvas id="regChart"></canvas>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('regChart').getContext('2d');

    const labels = {!! json_encode($labels) !!};
    const dataValues = {!! json_encode($values) !!};

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Regisztrációk (db)',
          data: dataValues,
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: true },
          tooltip: {
            callbacks: {
              label: function (ctx) {
                const v = ctx.parsed.y || 0;
                return new Intl.NumberFormat('hu-HU').format(v) + ' db';
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: (v) => new Intl.NumberFormat('hu-HU').format(v)
            }
          }
        }
      }
    });
  </script>
@endpush
