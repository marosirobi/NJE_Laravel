<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagramController extends Controller
{
    public function index(Request $request)
    {
        // Elérhető évek a lelekszam táblából
        $years = DB::table('lelekszam')
            ->select('ev')
            ->distinct()
            ->orderByDesc('ev')
            ->pluck('ev')
            ->toArray();

        // alapértelmezett év: legfrissebb
        $year = $request->integer('year', $years[0] ?? date('Y'));

        // Megyénkénti össznépesség az adott évben
        $rows = DB::table('lelekszam as l')
            ->join('varosok as v', 'l.varosid', '=', 'v.id')
            ->join('megyek as m', 'v.megyeid', '=', 'm.id')
            ->where('l.ev', $year)
            ->groupBy('m.id', 'm.nev')
            ->select('m.nev as megye', DB::raw('SUM(l.osszesen) as ossz_nepesseg'))
            ->orderBy('megye')
            ->get();

        $labels = $rows->pluck('megye')->values();
        $values = $rows->pluck('ossz_nepesseg')->map(fn($v) => (int)$v)->values();

        return view('diagram', [
            'years'  => $years,
            'year'   => $year,
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}
