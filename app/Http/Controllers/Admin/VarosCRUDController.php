<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Varos;
use App\Models\Megye;
use App\Models\Lelekszam;
use Illuminate\Http\Request;

class VarosCRUDController extends Controller
{
    /**
     * READ (Listázás)
     * Megjeleníti az összes várost, lapozhatóan.
     */
    public function index(Request $request) // <-- Változás: Request fogadása
    {
        // 1. Megyék lekérdezése a szűrőhöz
        $megyek = Megye::orderBy('nev')->get();

        // 2. Lekérdezés építő indítása
        $varosokQuery = Varos::with('megye');

        // 3. Szűrés: Megye
        if ($request->filled('megye')) {
            $varosokQuery->where('megyeid', $request->input('megye'));
        }

        // 4. Szűrés: Városnév
        if ($request->filled('varos')) {
            $varosokQuery->where('nev', 'LIKE', '%' . $request->input('varos') . '%');
        }

        // 5. Lekérdezés futtatása lapozással
        $varosok = $varosokQuery->orderBy('nev')->paginate(20);

        // 6. Visszaküldjük a nézetnek a szűrt/lapozott adatokat ÉS a megyéket
        return view('admin.varosok.index', [
            'varosok' => $varosok,
            'megyek'  => $megyek
        ]);
    }

    /**
     * CREATE (Létrehozó űrlap)
     * Megjeleníti az űrlapot új város felvételéhez.
     */
    public function create()
    {
        $megyek = Megye::orderBy('nev')->get(); // A megye legördülőhöz
        return view('admin.varosok.create', compact('megyek'));
    }

    /**
     * STORE (Létrehozás mentése)
     * Validálja és elmenti az új várost az adatbázisba.
     */
    public function store(Request $request)
    {
        // Validáció
        $validated = $request->validate([
            'nev' => 'required|string|max:255|unique:varosok',
            'megyeid' => 'required|integer|exists:megyek,id',
            'megyeszekhely' => 'required|boolean',
            'megyeijogu' => 'required|boolean',
        ]);

        Varos::create($validated);

        return redirect()->route('admin.varosok.index')
                         ->with('success', 'Város sikeresen létrehozva.');
    }

    /**
     * EDIT (Szerkesztő űrlap)
     * Megjeleníti az űrlapot egy meglévő város szerkesztéséhez.
     * A {varos} paraméter automatikusan betöltődik a Varos modell alapján.
     */
    public function edit(Varos $varosok)
{
    $megyek = Megye::orderBy('nev')->get();

    // EZ AZ ÚJ SOR: Betöltjük a városhoz tartozó lélekszámokat,
    // év szerint csökkenő sorrendben
    $varosok->load(['lelekszamok' => function ($query) {
        $query->orderBy('ev', 'desc');
    }]); 

    return view('admin.varosok.edit', [
        'varos' => $varosok, // Átadjuk a szerkesztendő várost (a paraméter neve $varosok)
        'megyek' => $megyek
    ]);
}

    /**
     * UPDATE (Szerkesztés mentése)
     * Validálja és frissíti a meglévő várost az adatbázisban.
     */
    public function update(Request $request, Varos $varosok)
    {
        // Validáció
        $validated = $request->validate([
            // Az 'unique' szabálynál meg kell mondani, hogy hagyja figyelmen kívül a saját ID-jét
            'nev' => 'required|string|max:255|unique:varosok,nev,' . $varosok->id,
            'megyeid' => 'required|integer|exists:megyek,id',
            'megyeszekhely' => 'required|boolean',
            'megyeijogu' => 'required|boolean',
        ]);

        $varosok->update($validated);

        return redirect()->route('admin.varosok.index')
                         ->with('success', 'Város sikeresen frissítve.');
    }

    /**
     * DELETE (Törlés)
     * Törli a várost az adatbázisból.
     */
    public function destroy(Varos $varosok)
    {
        try {
            // Megpróbáljuk törölni
            $varosok->delete();
            return redirect()->route('admin.varosok.index')
                             ->with('success', 'Város sikeresen törölve.');

        } catch (\Illuminate\Database\QueryException $e) {
            // Elkapjuk, ha foreign key hiba történik (pl. lélekszám adat hivatkozik rá)
            return redirect()->route('admin.varosok.index')
                             ->with('error', 'A város nem törölhető, mert lélekszám adat hivatkozik rá.');
        }
    }

    public function storeLelekszam(Request $request, Varos $varosok)
{
    // Validáció
    $validated = $request->validate([
        // Az 'ev'-nek egyedinek kell lennie AZON A VÁROSON BELÜL
        // A 'unique' szabály formátuma: unique:tábla,oszlop,kivéve_id,id_oszlop,extra_where_oszlop,extra_where_érték
        'ev' => 'required|integer|min:1900|max:2100|unique:lelekszam,ev,NULL,id,varosid,' . $varosok->id,
        'no' => 'required|integer|min:0',
        'osszesen' => 'required|integer|min:0|gte:no', // Összesen >= nők
    ], [
        // Egyedi hibaüzenetek
        'ev.unique' => 'Ehhez az évhez már van adat rögzítve ennél a városnál.',
        'osszesen.gte' => 'Az "Összesen" érték nem lehet kisebb, mint a "Nők száma".'
    ]);

    // Adat mentése a kapcsolaton keresztül
    $varosok->lelekszamok()->create($validated);

    // Visszairányítás a szerkesztő oldalra
    return redirect()->route('admin.varosok.edit', $varosok)
                     ->with('success', 'Új lélekszám adat sikeresen hozzáadva.');
}

/**
 * DESTROY LELEKSZAM (Új metódus)
 * Töröl egy lélekszám adatot.
 */
public function destroyLelekszam($varosid, $ev)
{
    // 1. Nem kérdezzük le, hanem KÖZVETLENÜL törlünk
    //    a Query Builder segítségével.
    Lelekszam::where('varosid', $varosid)
             ->where('ev', $ev)
             ->delete(); // Ez egy SQL DELETE parancsot futtat

    // 2. A visszairányításhoz szükséges $varosid-t
    //    már megkaptuk paraméterként.
    return redirect()->route('admin.varosok.edit', $varosid)
                     ->with('success', 'Lélekszám adat sikeresen törölve.');
}

}