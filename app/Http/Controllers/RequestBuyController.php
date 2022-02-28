<?php

namespace App\Http\Controllers;

use App\Models\RequestBuy;
use App\Http\Requests\StoreRequestBuyRequest;
use App\Http\Requests\UpdateRequestBuyRequest;

class RequestBuyController extends Controller
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
     * @param  \App\Http\Requests\StoreRequestBuyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestBuyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestBuy  $requestBuy
     * @return \Illuminate\Http\Response
     */
    public function show(RequestBuy $requestBuy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestBuy  $requestBuy
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestBuy $requestBuy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestBuyRequest  $request
     * @param  \App\Models\RequestBuy  $requestBuy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestBuyRequest $request, RequestBuy $requestBuy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestBuy  $requestBuy
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestBuy $requestBuy)
    {
        //
    }
}
