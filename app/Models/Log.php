<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $dates = ['date'];

    //deixa atulizar tudo
    protected $guarded = [];


    public static function salvandoLog($cpf, $acao)
    {
        DB::table('logs')->insert([
            'acao' => $acao,
            'cpf_log' => $cpf,
            'data_log' => now(),
        ]);
    }
}
