<?php

namespace App\Http\Controllers;

use App\Models\Postage;
use App\Http\Requests\StorePostageRequest;
use App\Http\Requests\UpdatePostageRequest;

class PostageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.ongkir', [
            'title' => 'Ongkos Pengiriman',
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
     * @param  \App\Http\Requests\StorePostageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postage  $postage
     * @return \Illuminate\Http\Response
     */
    public function show(Postage $postage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Postage  $postage
     * @return \Illuminate\Http\Response
     */
    public function edit(Postage $postage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostageRequest  $request
     * @param  \App\Models\Postage  $postage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostageRequest $request, Postage $postage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postage  $postage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postage $postage)
    {
        //
    }
}
