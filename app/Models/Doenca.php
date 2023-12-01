<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doenca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'sintomas',
    ];

    //deixa atulizar tudo
    protected $guarded = [];


    //regras da model Doenca
    public function regras(){
        $regras = [
            'nome' => 'required|min:3|max:100',
            'sintomas' => 'required|min:5|max:2000'
        ];
       return $regras;
    }

    public function feedback(){

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido.',
            'nome.min' => 'o campo nome deve ter no mínino 3 caracteres',
            'nome.max' => 'o campo nome deve ter no máximo 100 caracteres',
            'sintomas.min' => 'o campo sintomas deve ter no mínino 5 caracteres',
            'sintomas.max' => 'o campo sintomas deve ter no máximo 2000 caracteres'
        ];

        return $feedback;
    }


    
    // 1 doenca para várias questões
    public function question()
    {
        return $this->hasMany('App\Models\Question');
    }
}
