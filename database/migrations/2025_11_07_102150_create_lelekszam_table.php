<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lelekszam', function (Blueprint $table) {
        
        $table->foreignId('varosid')->constrained('varosok');
        
        $table->integer('ev');
        $table->integer('no');
        $table->integer('osszesen');

        $table->primary(['varosid', 'ev']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lelekszam');
    }
};
