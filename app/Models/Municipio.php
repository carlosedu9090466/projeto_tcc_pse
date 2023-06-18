<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipios';

    protected $guarded = [];


    // 1 municipio pode ter várias escolas
    public function MunicipioVariasEscolas()
    {
        return $this->hasMany('App\Models\Escola');
    }
}
