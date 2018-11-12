<?php

namespace App\Http\Controllers;
use App\Programma;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmas = Programma::all();
        return view('welcome', compact('programmas'));
    }
}
