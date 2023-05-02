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

    // 1 doenca para várias questões
    public function question()
    {
        return $this->hasMany('App\Models\Question');
    }
}
