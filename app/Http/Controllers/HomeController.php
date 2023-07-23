<?php

namespace App\Http\Controllers;

use App\Models\Escola;
use App\Models\Municipio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // proteger a home controller
    public function __construct()
    {
        $this->middleware('auth');
    }


    //page home
    public function index()
    {
        $auth = Auth::user()->toArray();

        if ($auth['role_id'] == 2) {
            $user = User::with('UserEscolarVinculo')->findOrFail($auth['id']);
            return view('home', ['auth' => $auth, 'user' => $user]);
        } else {
            return view('home', ['auth' => $auth]);
        }
    }
}
