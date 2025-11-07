<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Megye; // Használjuk a Modellt
use Illuminate\Support\Facades\File; // Használjuk a File kezelőt

class MegyeSeeder extends Seeder
{
    public function run(): void
{
    // Beolvassuk a fájlt, átugorjuk az 1. sort (fejléc),
    // és a többit feldolgozzuk
    File::lines(database_path('data/megye.txt'))
        ->skip(1)
        ->each(function ($line) {
            
            $data = explode("\t", $line); 
            Megye::create([
                'id' => (int)$data[0],
                'nev' => $data[1],
            ]);
        });
}
}