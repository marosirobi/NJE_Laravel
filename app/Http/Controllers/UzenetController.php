<?php

namespace App\Http\Controllers;
use App\Models\KapcsolatUzenet; // A modell, amibe mentettünk
use Illuminate\Http\Request;

class UzenetController extends Controller
{
    public function index()
    {
        // Üzenetek lekérdezése adatbázisból 
        // Fordított időrendben (legfrissebb elől) 
        $uzenete = KapcsolatUzenet::orderBy('created_at', 'desc')->get();
        
        return view('uzenetek', compact('uzenete'));
    }
}
