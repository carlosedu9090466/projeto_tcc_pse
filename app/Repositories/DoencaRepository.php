<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Doenca;

class DoencaRepository {

    //salvando os dados
    public function createDoenca(Request $request){
        return Doenca::create($request->all());
    }

}

?>