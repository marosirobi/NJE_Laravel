<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Megye extends Model
{
    use HasFactory;
    
    // Nincsenek 'created_at'/'updated_at' oszlopaink
    protected $table = 'megyek';
    public $timestamps = false;
    
    // Mezők, amik tömegesen kitölthetők a Seederből
    protected $fillable = ['id', 'nev'];

    // 1-N kapcsolat: Egy megyének több városa van
    public function varosok(): HasMany
    {
        return $this->hasMany(Varos::class, 'megyeid');
    }
}