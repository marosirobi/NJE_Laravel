<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagramController extends Controller
{
    public function index(Request $request)
    {
        // Elérhető évek a users táblából (created_at alapján)
        $years = DB::table('users')
            ->selectRaw('YEAR(created_at) as y')
            ->whereNotNull('created_at')
            ->distinct()
            ->orderByDesc('y')
            ->pluck('y')
            ->toArray();

        $currentYear = (int)date('Y');
        $year = (int)$request->input('year', $years[0] ?? $currentYear);

        // 12 hónap előkészítése 0-kal
        $labelsHu = ['Jan','Feb','Már','Ápr','Máj','Jún','Júl','Aug','Sze','Okt','Nov','Dec'];
        $values = array_fill(0, 12, 0);

        // Havi regisztrációk lekérdezése az adott évre
        $rows = DB::table('users')
            ->selectRaw('MONTH(created_at) as m, COUNT(*) as c')
            ->whereYear('created_at', $year)
            ->groupBy('m')
            ->orderBy('m')
            ->get();

        foreach ($rows as $r) {
            $idx = (int)$r->m - 1;           // 0..11
            if ($idx >= 0 && $idx < 12) {
                $values[$idx] = (int)$r->c;
            }
        }

        return view('diagram', [
            'years'  => $years,
            'year'   => $year,
            'labels' => $labelsHu,
            'values' => $values,
        ]);
    }
}
