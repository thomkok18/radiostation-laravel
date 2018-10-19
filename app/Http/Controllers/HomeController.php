<?php

namespace App\Http\Controllers;

use App\Liedje;
use App\Programma;
use Illuminate\Http\Request;

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
        $programmas = Programma::paginate(10);
        $liedjes = Liedje::paginate(10);
        return view('welcome', compact('programmas', 'liedjes'));
    }
}
