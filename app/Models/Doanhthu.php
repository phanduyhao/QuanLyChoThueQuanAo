<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doanhthu extends Model
{
    use HasFactory;
    public function Kho()
    {
        return $this->belongsTo( Kho::class, 'id_kho','id');
    }
    public function Chothue()
    {
        return $this->belongsTo( Chothue::class, 'id_chothue','id');
    }
}
