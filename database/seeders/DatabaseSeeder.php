<?php

namespace Database\Seeders;

// Ezekre az új 'use' sorokra szükség lesz:
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Megye;
use App\Models\Varos;
use App\Models\Lelekszam;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // 2. Táblák kiürítése (truncate) fordított sorrendben
        Lelekszam::truncate();
        Varos::truncate();
        Megye::truncate();

        // 3. Biztonsági ellenőrzések VISSZAKAPCSOLÁSA
        Schema::enableForeignKeyConstraints();

        // 4. Seederek futtatása helyes sorrendben
        $this->call(MegyeSeeder::class);
        $this->call(VarosSeeder::class);
        $this->call(LelekszamSeeder::class);
    }
}
