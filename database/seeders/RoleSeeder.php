<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->role = 'ADMISTRADOR';
        $role->abreviacao = 'ADM';
        $role->save();

        $role = new Role();
        $role->role = 'Usuário Escolar';
        $role->abreviacao = 'ADM-Escolar';
        $role->save();

        $role = new Role();
        $role->role = 'Agente Saúde';
        $role->abreviacao = 'AGT.Saúde';
        $role->save();

        $role = new Role();
        $role->role = 'Aluno';
        $role->abreviacao = 'Aluno';
        $role->save();
    }
}
