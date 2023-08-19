<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agente extends Model
{
    use HasFactory;

    protected $table = 'agentes';
    protected $dates = ['date'];

    //deixa atulizar tudo
    protected $guarded = [];

    public static function AgenteInformacoes($id)
    {
        $agente = DB::table('users')
            ->join('agentes', 'users.id', '=', 'agentes.user_id')
            ->where('agentes.id', '=', $id)
            ->select('users.name', 'users.email', 'agentes.id', 'agentes.codigo_agente', 'agentes.cpf', 'agentes.sexo', 'agentes.dataNascimento', 'agentes.status_conta')
            ->get();

        return $agente[0];
    }
}
