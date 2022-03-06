<?php

namespace App\Http\Controllers;

use App\Models\Spice;
use App\Http\Requests\StoreSpiceRequest;
use App\Http\Requests\UpdateSpiceRequest;

class SpiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.spice', [
            'title' => 'Rempah',
        ]);
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
     * @param  \App\Http\Requests\StoreSpiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spice  $spice
     * @return \Illuminate\Http\Response
     */
    public function show(Spice $spice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spice  $spice
     * @return \Illuminate\Http\Response
     */
    public function edit(Spice $spice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpiceRequest  $request
     * @param  \App\Models\Spice  $spice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpiceRequest $request, Spice $spice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spice  $spice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spice $spice)
    {
        //
    }
}
