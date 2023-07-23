<?php

namespace Database\Seeders;

use App\Models\Serie;
use Illuminate\Database\Seeder;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serie = new Serie();
        $serie->serie = '1EF';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '2EF';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '3EF';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '4EF';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '5EF';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '6EF';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '7EF';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '8EF';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '9EF';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '1EM';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '2EM';
        $serie->save();

        $serie = new Serie();
        $serie->serie = '3EM';
        $serie->save();
    }
}
