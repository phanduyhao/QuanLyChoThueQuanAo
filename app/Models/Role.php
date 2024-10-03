<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
    const ADMIN = 1;
    const CTV = 2;

    public function isAdmin()
    {
        return $this->id == self::ADMIN;
    }
}
