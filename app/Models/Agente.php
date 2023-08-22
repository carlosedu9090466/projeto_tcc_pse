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

    public static function agenteVinculoEscolas($id_user)
    {
        $escolas = DB::table('agentes')
            ->join('agentes_escolas', 'agentes.id', '=', 'agentes_escolas.agente_id')
            ->join('escolas', 'agentes_escolas.escola_id', '=', 'escolas.id')
            ->join('municipios', 'municipios.id', '=', 'escolas.localidade_id')
            ->where('agentes.user_id', '=', $id_user)
            ->select('agentes.id as id_agente', 'agentes.codigo_agente', 'agentes.cpf', 'agentes_escolas.status_agente_escola', 'escolas.id as id_escola', 'escolas.nome', 'escolas.inep', 'municipios.nome as municipio')
            ->get();

        return $escolas;
    }


    public function UserAgenteVinculo()
    {
        //um Agente pode ser vinculado em várias Escolas
        return $this->belongsToMany(Escola::class, 'agentes_escolas', 'agente_id', 'escola_id');
    }
}
