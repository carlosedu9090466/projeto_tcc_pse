<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    use HasFactory;

    protected $table = 'escolas';

    protected $guarded = [];

    // 1 Escola pode está apenas num municipio
    public function EscolaMunicipioOne()
    {
        return $this->belongsTo('App\Models\Municipio', 'localidade_id', 'id');
    }
}
