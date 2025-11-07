<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lelekszam; // Használjuk a Modellt
use Illuminate\Support\Facades\File;

class LelekszamSeeder extends Seeder
{
    public function run(): void
{
    File::lines(database_path('data/lelekszam.txt'))
        ->skip(1)
        ->each(function ($line) {
        
            $data = explode("\t", $line);
            Lelekszam::create([
                'varosid' => (int)$data[0],
                'ev' => (int)$data[1],
                'no' => (int)$data[2],
                'osszesen' => (int)$data[3],
            ]);
        });
}
}