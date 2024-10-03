<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kho extends Model
{
    use HasFactory;
    public function Product()
    {
        return $this->belongsTo( Product::class, 'id_product','id');
    }
}
