<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use Illuminate\Http\Request;

class MonsterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $monsters = Monster::all();
        return view('monster.index',compact('monsters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Monster $monster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Monster $monster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monster $monster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monster $monster)
    {
        //
    }
}
