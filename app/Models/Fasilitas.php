<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;
    protected $table = 'fasilitas';

    public function hotel()
    {
        return $this->belongsToMany(Hotel::class, 'fasilitas_hotel');
    }
}
