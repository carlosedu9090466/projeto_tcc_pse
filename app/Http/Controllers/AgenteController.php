<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgenteController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     *
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => ['required'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    public function create()
    {
        $roles = Role::where('id', '=', 3)->get();
        return view('agente.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        //criando agente
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/')->with('msg', 'Agente cadastrado com sucesso!');
    }

    public function homeAgente()
    {

        return view('agente.createVinculo');
    }
}
