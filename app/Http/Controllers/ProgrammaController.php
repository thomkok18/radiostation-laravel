<?php

namespace App\Http\Controllers;

use App\Liedje;
use App\Programma;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgrammaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages/programma', compact('users'));
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
            'presentator' => 'required',
            'naam' => 'required',
            'starttijd' => 'required|before_or_equal:eindtijd',
            'eindtijd' => 'required|after_or_equal:starttijd',
            'datum' => 'required|date'
        ]);

        $programma->create([
            'user_id' => request('presentator'),
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
        $liedjes = DB::table('liedjes')->where('programma_id', $id)->get();
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
        if (auth()->user()->id == $programma->user_id) {
            return view('edit/programma')->with(compact('programma'));
        } else {
            abort('403');
        }
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
            'starttijd' => 'required|before_or_equal:eindtijd',
            'eindtijd' => 'required|after_or_equal:starttijd',
            'datum' => 'required|date'
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
        if (auth()->user()->id == $programma->user_id) {
            $programma->delete();
            return back()->with('success', 'Programma verwijderd');
        } else {
            abort('403');
        }
    }
}
