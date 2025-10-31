<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapcsolatUzenet extends Model
{
    use HasFactory;
    // Engedélyezzük ezen mezők mentését
    protected $fillable = ['nev', 'email', 'uzenet'];
}