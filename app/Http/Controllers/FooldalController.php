<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Fontos, hogy ez be legyen töltve

class FooldalController extends Controller
{
    /**
     * Megjeleníti a főoldalt (a cégbemutatót).
     */
    public function index(): View
    {
        // Ez mondja meg a Laravelnek, hogy töltse be
        // a 'resources/views/fooldal.blade.php' fájlt
        return view('fooldal');
    }
}
