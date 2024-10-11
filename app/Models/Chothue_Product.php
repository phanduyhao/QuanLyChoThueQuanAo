<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chothue_Product extends Model
{
    use HasFactory;
    protected $table = 'chothue_products';
    
    public function Product()
    {
        return $this->belongsTo( Product::class, 'id_product','id');
    }
    public function Chothue()
    {
        return $this->belongsTo( Chothue::class, 'id_chothue','id');
    }
}
