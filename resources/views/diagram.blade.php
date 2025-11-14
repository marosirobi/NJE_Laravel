@extends('layouts.main')
@section('title', 'Diagram')

@section('content')
  <h2>Megyénkénti össznépesség</h2>
  <p>Az alábbi diagram az adott évben a megyék össznépességét mutatja (városok <em>lélekszám</em> rekordjai alapján).</p>

  <form method="GET" action="{{ route('diagram.index') }}" style="margin:12px 0 20px;">
    <label>Év:
      <select name="year" onchange="this.form.submit()">
        @foreach ($years as $y)
          <option value="{{ $y }}" {{ (int)$y === (int)$year ? 'selected' : '' }}>{{ $y }}</option>
        @endforeach
      </select>
    </label>
  </form>

  <div style="max-width:1100px;">
    <canvas id="chart"></canvas>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const labels = {!! json_encode($labels) !!};
    const values = {!! json_encode($values) !!};

    const ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels,
        datasets: [{
          label: 'Össznépesség (fő)',
          data: values
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: true },
          tooltip: {
            callbacks: {
              label: (ctx) => new Intl.NumberFormat('hu-HU').format(ctx.parsed.y || 0) + ' fő'
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { callback: (v) => new Intl.NumberFormat('hu-HU').format(v) }
          }
        }
      }
    });
  </script>
@endsection
