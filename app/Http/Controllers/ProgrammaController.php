<?php

namespace App\Http\Controllers;

use App\Liedje;
use App\Programma;
use Illuminate\Http\Request;

class ProgrammaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/programma');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Programma $programma
     * @return void
     */
    public function store(Programma $programma)
    {
        request()->validate([
            'naam' => 'required',
            'starttijd' => 'required',
            'eindtijd' => 'required',
            'datum' => 'required'
        ]);

        $programma->create([
            'naam' => request('naam'),
            'starttijd' => request('starttijd'),
            'eindtijd' => request('eindtijd'),
            'datum' => request('datum'),
        ]);

        return redirect('/')->with('success', 'Programma aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programma = Programma::find($id);
        $liedjes = Liedje::all();
        return view('pages/liedjesoverzicht', compact('programma', 'liedjes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programma = Programma::find($id);
        return view('edit/programma')->with(compact('programma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Programma $programma
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Programma $programma)
    {
        request()->validate([
            'naam' => 'required',
            'starttijd' => 'required',
            'eindtijd' => 'required',
            'datum' => 'required'
        ]);

        $programma->update([
            'naam' => request('naam'),
            'starttijd' => request('starttijd'),
            'eindtijd' => request('eindtijd'),
            'datum' => request('datum'),
        ]);

        return redirect('/')->with('success', 'Programma aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programma = Programma::find($id);
        $programma->delete();
        return back()->with('success', 'Programma verwijderd');
    }
}
