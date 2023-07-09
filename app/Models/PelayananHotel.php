<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananHotel extends Model
{
    use HasFactory;
    protected $table = 'pelayanan_hotel';
    protected $guarded = ['id'];
}
