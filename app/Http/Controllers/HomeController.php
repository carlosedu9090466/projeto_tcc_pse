<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //page home
    public function index()
    {
        return view('home');
    }
}
