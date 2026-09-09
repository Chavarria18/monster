<?php

namespace App\Http\Controllers;

use App\Models\Combat;
use App\Models\Monster;
use Illuminate\Http\Request;
use App\Services\CombatService;
use Illuminate\Support\Facades\DB;
class CombatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $ids = $request->input('monsters', []);
        if (count($ids) !== 2) {

            return back()->with('error', 'Select exactly 2 monsters.');
        }

        $combats = Monster::findMany($ids);

        return view('combat.index', compact('combats'));
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
    public function show(Combat $combat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Combat $combat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Combat $combat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Combat $combat)
    {

        $combat->delete();

        return redirect()->route('history.index')
            ->with('success', 'Combat deleted successfully.');
    }

    public function fight($id1, $id2, CombatService $combatService)
    {
        
        $monster1 = Monster::findOrFail($id1);
        $monster2 = Monster::findOrFail($id2);

        if(is_null($monster1) || is_null($monster2)){
             return redirect()->route('combat.index')
            ->with('error', 'Can init fight');
        }

        $result = $combatService->procesFight($monster1, $monster2);

        $this->saveHistory(
            $monster1->id,
            $monster2->id,
            $result['winner']->id
        );

        return response()->json([
            'monster1' => $monster1->name,
            'monster1_life' => $result['monster1Life'],
            'monster1_initial_life' => $monster1->life,

            'monster2' => $monster2->name,
            'monster2_life' => $result['monster2Life'],
            'monster2_initial_life' => $monster2->life,

            'winner' => $result['winner']->name,
            'winner_id' => $result['winner']->id,

            'fightLog' => $result['fightLog'],
        ]);
    }

    public function saveHistory($f1, $f2, $w)
    {
        $combat = new Combat();
        $combat->fighter_1 = $f1;
        $combat->fighter_2 = $f2;
        $combat->winner = $w;
        $combat->save();
    }

    public function history()
    {
        $history = Combat::with([
            'fighter1',
            'fighter2',
            'winnerMonster'
        ])->paginate(10);

        $topWinners = Combat::select(
            'winner',
            DB::raw('COUNT(*) as wins')
        )
        ->whereNotNull('winner_id')
        ->groupBy('winner')
        ->orderByDesc('wins')
        ->take(3)
        ->with('winnerMonster')
        ->get();


        return view('history.index', compact('history','topWinners'));
    }

}
