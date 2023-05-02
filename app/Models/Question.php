<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    //deixa atulizar tudo
    protected $guarded = [];



    //várias questão pode ter uma doença
    public function doencas()
    {
        return $this->belongsTo('App\Models\Doenca', 'doenca_id', 'id');
    }
}
