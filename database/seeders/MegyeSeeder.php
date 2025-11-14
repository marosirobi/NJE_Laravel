<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Megye; // Használjuk a Modellt
use Illuminate\Support\Facades\File; // Használjuk a File kezelőt
use Illuminate\Support\Facades\Schema;

class MegyeSeeder extends Seeder
{
    public function run(): void
{
    // Beolvassuk a fájlt, átugorjuk az 1. sort (fejléc),
    // és a többit feldolgozzuk
    Schema::disableForeignKeyConstraints();
    File::lines(database_path('data/megye.txt'))
        ->skip(1)
        ->each(function ($line) {
            
            $data = explode("\t", $line); 
            print(implode(",",$data));
            Megye::create([
                'id' => (int)$data[0],
                'nev' => $data[1],
            ]);
        });

    Schema::enableForeignKeyConstraints();
}
}