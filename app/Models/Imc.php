<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imc extends Model
{
    use HasFactory;

    protected $table = 'imcs';
    protected $dates = ['date'];

    //deixa atulizar tudo
    protected $guarded = [];


    public static function validaStringNumerica($string)
    {
        $semPontoVirgula = str_replace(array('.', ','), '', $string);

        if (is_numeric($semPontoVirgula)) {
            $p = str_replace(array('.', ','), '.', $string);
            return floatval($p);
        } else {
            return false;
        }
    }

    public static function calcularImc(float $altura, float $peso)
    {
        $imc = $peso / ($altura * $altura);
        $imc_format =  number_format($imc, 1);
        return floatval($imc_format);
    }

    public static function grauImc(float $imc)
    {

        switch ($imc) {
            case ($imc < 18.5):
                return 'Abaixo do Peso';
                break;
            case ($imc >= 18.5 && $imc < 24.9):
                return 'Peso Normal';
                break;
            case ($imc >= 25 && $imc < 29.9):
                return 'Sobrepeso';
                break;
            case ($imc >= 30 && $imc < 34.9):
                return 'Obesidade Grau I';
                break;
            case ($imc >= 35 && $imc < 39.9):
                return 'Obesidade Grau II';
                break;
            default:
                return 'Obesidade Grau III';
                break;
        }
    }
}
