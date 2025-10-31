<?php

namespace App\Http\Controllers;

use App\Models\KapcsolatUzenet; // Modell importálása
use App\Http\Requests\StoreKapcsolatRequest; // Validáció importálása

class KapcsolatController extends Controller
{
    // Ez jeleníti meg az űrlapot
    public function index()
    {
        return view('kapcsolat');
    }

    // Ez dolgozza fel az űrlapot
    public function store(StoreKapcsolatRequest $request)
    {
        // A validáció automatikusan lefut a StoreKapcsolatRequest miatt
        
        // Adatbázisba mentés 
        KapcsolatUzenet::create($request->validated());

        // Visszairányítás egy sikeres üzenettel
        return redirect()->route('kapcsolat.index')
                         ->with('success', 'Üzenetét sikeresen elküldtük!');
    }
}
