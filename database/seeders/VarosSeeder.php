<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Varos; // Használjuk a Modellt
use Illuminate\Support\Facades\File;

class VarosSeeder extends Seeder
{
    public function run(): void
{
    File::lines(database_path('data/varos.txt'))
        ->skip(1)
        ->each(function ($line) {

            $data = explode("\t", $line);
            Varos::create([
                'id' => (int)$data[0],
                'nev' => $data[1],
                'megyeid' => (int)$data[2],
                'megyeszekhely' => (bool)$data[3],
                'megyeijogu' => (bool)$data[4],
            ]);
        });
}
}
