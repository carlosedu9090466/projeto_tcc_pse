<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEscolar extends Model
{
    use HasFactory;

    protected $table = 'user_escolars';
    protected $dates = ['date'];

    protected $guarded = [];
    protected $fillable = [
        'cpf', 'telefone', 'sexo', 'data_nascimento'
    ];

    public function UserEscolarVinculo()
    {
        //um UserEscolar pode ser vinculado em várias Escolas
        return $this->belongsToMany(Escola::class, 'escola_users', 'user_id', 'escola_id');
        //return $this->belongsToMany('App\Models\Escola');
    }
}
