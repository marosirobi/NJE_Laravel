<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lelekszam extends Model
{
    use HasFactory;
    
    // A tábla neve 'lelekszam'
    protected $table = 'lelekszam';

    // Nincsenek 'created_at'/'updated_at' oszlopaink
    public $timestamps = false;

    // Jelezzük, hogy az 'id' nem auto-incrementing (mert nincs is)
    public $incrementing = false;
    
    // Beállítjuk az összetett kulcsot Eloquent számára
    protected $primaryKey = ['varosid', 'ev'];

    // Mezők, amik tömegesen kitölthetők
    protected $fillable = ['varosid', 'ev', 'no', 'osszesen'];

    // N-1 kapcsolat: Egy lélekszám adat egy városhoz tartozik
    public function varos(): BelongsTo
    {
        return $this->belongsTo(Varos::class, 'varosid');
    }
}