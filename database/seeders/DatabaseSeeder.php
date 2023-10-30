<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        $this->call(MunicipioSeeder::class);
        $this->call(GenerosSexuais::class);
        $this->call(RoleSeeder::class);
        $this->call(SerieSeeder::class);
        $this->call(SalaSeeder::class);
        \App\Models\User::factory(1)->create();
    }
}
