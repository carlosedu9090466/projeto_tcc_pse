<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Seeder;

class GenerosSexuais extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $genero = new Genero();
        $genero->genero = 'Heterossexual';
        $genero->save();

        $genero = new Genero();
        $genero->genero = 'Homossexual';
        $genero->save();

        $genero = new Genero();
        $genero->genero = 'Bissexual';
        $genero->save();

        $genero = new Genero();
        $genero->genero = 'Mulher Trans';
        $genero->save();

        $genero = new Genero();
        $genero->genero = 'Homem Trans';
        $genero->save();

        $genero = new Genero();
        $genero->genero = 'Travesti';
        $genero->save();

        $genero = new Genero();
        $genero->genero = 'Lésbica';
        $genero->save();

        $genero = new Genero();
        $genero->genero = 'Cisgênero';
        $genero->save();

        $genero = new Genero();
        $genero->genero = 'Não binário';
        $genero->save();
    }
}
