<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Http\Requests\StoreexpenditureRequest;
use App\Http\Requests\UpdateexpenditureRequest;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.expenditure', [
            'title' => 'Pengeluaran',
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
     * @param  \App\Http\Requests\StoreexpenditureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreexpenditureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function show(expenditure $expenditure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function edit(expenditure $expenditure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateexpenditureRequest  $request
     * @param  \App\Models\expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateexpenditureRequest $request, expenditure $expenditure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function destroy(expenditure $expenditure)
    {
        //
    }
}
