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
        return view('monster.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'life'     => 'required|integer|min:1',
        'atack'    => 'required|integer|min:0',
        'defense'  => 'required|integer|min:0',
        'velocity' => 'required|integer|min:0',
        'image'    => 'nullable|image|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('monsters', 'public');
        }

        Monster::create($validated);
        return redirect()->route('monster.index')->with('success', 'Monstruo creado con éxito.');
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
        return view('monster.edit', compact('monster'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monster $monster)
    {
         $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'life'     => 'required|integer|min:1',
        'atack'    => 'required|integer|min:0',
        'defense'  => 'required|integer|min:0',
        'velocity' => 'required|integer|min:0',
        'image'    => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')
            ->store('monsters', 'public');
    }

    $monster->update($validated);

    return redirect()
        ->route('monster.index')
        ->with('success', 'Monstruo actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monster $monster)
    {
        //
    }

    
}
