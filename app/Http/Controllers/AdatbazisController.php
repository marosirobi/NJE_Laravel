<?php

namespace App\Http\Controllers;

use App\Models\Varos;   // A Varos modell
use App\Models\Megye;   // <-- ÚJ: Kell a megyék listájához
use Illuminate\Http\Request; // <-- ÚJ: Kell a szűrési adatok olvasásához

class AdatbazisController extends Controller
{
    /**
     * Megjeleníti a városok listáját, szűrhetően.
     */
    public function index(Request $request) // <-- Módosítva: Request fogadása
    {
        // 1. Lekérdezzük az összes megyét a szűrő legördülő menüjéhez
        $megyek = Megye::orderBy('nev')->get();

        // 2. Elindítjuk a városok lekérdezését,
        //    automatikusan betöltve a kapcsolódó megye és lélekszám adatokat
        $varosokQuery = Varos::with(['megye', 'lelekszamok']);

        // 3. SZŰRÉS ALKALMAZÁSA: Megye
        // Ellenőrizzük, hogy a 'megye' mező ki van-e töltve a HTTP kérésben
        if ($request->filled('megye')) {
            $varosokQuery->where('megyeid', $request->input('megye'));
        }

        // 4. SZŰRÉS ALKALMAZÁSA: Városnév (részlet)
        // Ellenőrizzük, hogy a 'varos' mező ki van-e töltve
        if ($request->filled('varos')) {
            // A '%' joker karakterrel 'LIKE' keresést végzünk
            $varosokQuery->where('nev', 'LIKE', '%' . $request->input('varos') . '%');
        }

        // 5. A lekérdezés véglegesítése és rendezése
        $varosok = $varosokQuery->orderBy('nev')->get();

        // 6. Átadjuk az adatokat a nézetnek
        return view('adatbazis', [
            'varosok' => $varosok,  // A (szűrt) városok listája
            'megyek'  => $megyek    // A megyék listája a legördülőhöz
        ]);
    }
}