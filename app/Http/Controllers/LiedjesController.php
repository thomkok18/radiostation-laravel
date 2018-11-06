<?php

namespace App\Http\Controllers;

use App\Liedje;
use App\Programma;
use Illuminate\Http\Request;

class LiedjesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmas = Programma::all();
        return view('pages/liedje', compact('programmas'));
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
     * @param Liedje $liedje
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'programma' => 'required',
            'artiestnaam' => 'required',
            'liedjenaam' => 'required',
            'lengte' => 'required'
        ]);

        $programma = Programma::find(request('programma'));

        if ($programma) {
            if ($programma->user_id == auth()->user()->id) {
                Liedje::create([
                    'programma_id' => request('programma'),
                    'user_id' => auth()->user()->id,
                    'artiestnaam' => request('artiestnaam'),
                    'liedjenaam' => request('liedjenaam'),
                    'lengte' => request('lengte')
                ]);

                return redirect('/programma/' . $programma->id)->with('success', 'Liedje toegevoegd');
            } else {
                abort('403');
            }
        } else {
            return back()->with('error', 'The programma field is required.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $liedje = Liedje::find($id);
        $programmas = Programma::all();
        if (auth()->user()->id == $liedje->user_id) {
            return view('edit/liedje')->with(compact('liedje', 'programmas'));
        } else {
            abort('403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Liedje $liedje
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Liedje $liedje)
    {
        $programma = Programma::find(request('programma_id'));

        request()->validate([
            'programma' => 'required',
            'artiestnaam' => 'required',
            'liedjenaam' => 'required',
            'lengte' => 'required'
        ]);

        if ($programma->user_id == auth()->user()->id) {
            $liedje->update([
                'programma_id' => request('programma'),
                'artiestnaam' => request('artiestnaam'),
                'liedjenaam' => request('liedjenaam'),
                'lengte' => request('lengte')
            ]);

            return redirect('/programma/' . $programma->id)->with('success', 'Liedje aangepast');
        } else {
            abort('403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $liedje = Liedje::find($id);
        if (auth()->user()->id == $liedje->user_id) {
            $liedje->delete();
            return back()->with('success', 'Liedje verwijderd');
        } else {
            abort('403');
        }
    }
}
