<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Varos extends Model
{
    use HasFactory;
    
    protected $table = 'varosok';
    public $timestamps = false;
    
    // Mezők, amik tömegesen kitölthetők
    protected $fillable = ['id', 'nev', 'megyeid', 'megyeszekhely', 'megyeijogu'];

    // N-1 kapcsolat: Egy város egy megyéhez tartozik
    public function megye(): BelongsTo
    {
        return $this->belongsTo(Megye::class, 'megyeid');
    }

    // 1-N kapcsolat: Egy városnak több évi lélekszám adata van
    public function lelekszamok(): HasMany
    {
        return $this->hasMany(Lelekszam::class, 'varosid');
    }
}