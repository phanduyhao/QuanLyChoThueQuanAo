<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chothue extends Model
{
    use HasFactory;
    protected $table = 'chothues';
    public function Product()
    {
        return $this->belongsTo( Product::class, 'id_product','id');
    }
    public function Nhanvien()
    {
        return $this->belongsTo( User::class, 'id_nhanvien','id');
    }
    public function Customer()
    {
        return $this->belongsTo( Customer::class, 'id_customer','id');
    }
}
