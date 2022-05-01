<?php

namespace App\Http\Controllers;

use App\Models\NewsSub;
use App\Http\Requests\StoreNewsSubRequest;
use App\Http\Requests\UpdateNewsSubRequest;

class NewsSubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreNewsSubRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsSubRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsSub  $newsSub
     * @return \Illuminate\Http\Response
     */
    public function show(NewsSub $newsSub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsSub  $newsSub
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsSub $newsSub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsSubRequest  $request
     * @param  \App\Models\NewsSub  $newsSub
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsSubRequest $request, NewsSub $newsSub)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsSub  $newsSub
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsSub $newsSub)
    {
        //
    }
}
