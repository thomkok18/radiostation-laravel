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
    public function store(Liedje $liedje)
    {
        request()->validate([
            'programma_id' => 'required',
            'artiestnaam' => 'required',
            'liedjenaam' => 'required',
            'lengte' => 'required'
        ]);

        $liedje->create([
            'programma_id' => request('programma_id'),
            'artiestnaam' => request('artiestnaam'),
            'liedjenaam' => request('liedjenaam'),
            'lengte' => request('lengte')
        ]);

        return redirect('/')->with('success', 'Liedje toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $liedje = Liedje::find($id);
        $programmas = Programma::all();
        return view('edit/liedje')->with(compact('liedje', 'programmas'));
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
        request()->validate([
            'artiestnaam' => 'required',
            'liedjenaam' => 'required',
            'lengte' => 'required'
        ]);

        $liedje->update([
            'artiestnaam' => request('artiestnaam'),
            'liedjenaam' => request('liedjenaam'),
            'lengte' => request('lengte')
        ]);

        return redirect('/')->with('success', 'Liedje aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $liedje = Liedje::find($id);
        $liedje->delete();
        return back()->with('success', 'Liedje verwijderd');
    }
}
