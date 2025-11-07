<?php

namespace App\Http\Controllers;

use App\Models\KapcsolatUzenet; // A KapcsolatUzenet modell
use Illuminate\Support\Facades\Auth; // Beépített autentikáció

class UzenetController extends Controller
{
    /**
     * Megjeleníti az üzeneteket jogosultság alapján.
     * Admin: Minden üzenetet lát.
     * User: Csak a saját üzeneteit látja.
     */
    public function index()
    {
        // 1. Lekérjük a bejelentkezett felhasználót
        $felhasznalo = Auth::user();

        // 2. Indítunk egy üres lekérdezés-építőt
        $query = KapcsolatUzenet::query();

        // 3. Megvizsgáljuk a felhasználó szerepkörét
        if ($felhasznalo->role == 'admin') {
            
            // Ha a felhasználó 'admin', NEM szűrünk semmit.
            // A lekérdezés az összes üzenetet vissza fogja adni.
        
        } else {
            
            // Ha a felhasználó NEM 'admin' (tehát sima 'user'),
            // akkor szűrünk a saját email címére.
            $query->where('email', $felhasznalo->email);
        }

        // 4. A lekérdezés véglegesítése:
        //    Bármi is történt (szűrtünk vagy sem), az eredményt
        //    csökkenő időrendbe állítjuk és lekérjük.
        $uzenete = $query->orderBy('created_at', 'desc')->get();
        
        // 5. Átadjuk a (megfelelően szűrt) listát a nézetnek.
        return view('uzenetek', compact('uzenete'));
    }
}