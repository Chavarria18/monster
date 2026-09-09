<?php

namespace App\Http\Controllers;

use App\Models\Combat;
use App\Models\Monster;
use Illuminate\Http\Request;

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
        //
    }

    public function figth($id1 = 1, $id2 = 2)
    {


        $monster1 = Monster::find($id1);

        $monster1Life = $monster1->life;
        $monster2 = Monster::find($id2);

        $monster2Life = $monster2->life;


        $keepFight = true;
        $turn = "";
        $fightLog = [];
        $step = 0;
        if ($monster1->velocity > $monster2->velocity) {
            $turn = "1";
        } else if ($monster1->velocity == $monster2->velocity) {
            $turn = $monster1->atack > $monster2->atack ? "1" : "2";
        } else {
            $turn = "2";
        }

        while ($keepFight) {
            if ($turn == "1") {
                $damage = max(1, $monster1->atack - $monster2->defense);
                $monster2Life -= $damage;
                $fightLog[] = [
                    'turn' => $step,
                    'attacker' => 1,
                    'defender' => 2,
                    'damage' => $damage,
                    'monster1Life' => max(0, $monster1Life),
                    'monster2Life' => max(0, $monster2Life),
                ];
            } else {
                $damage = max(1, $monster2->atack - $monster1->defense);
                $monster1Life -= $damage;
                $fightLog[] = [
                     'turn' => $step,
                    'attacker' => 2,
                    'defender' => 1,
                    'damage' => $damage,
                    'monster1Life' => max(0, $monster1Life),
                    'monster2Life' => max(0, $monster2Life),
                ];
            }

            if ($monster1Life <= 0 || $monster2Life <= 0) {
                $keepFight = false;
                $winner = ($monster1Life > 0) ? $monster1 : $monster2;
                break;
            }

            $turn = $turn == "1" ? "2" : "1";
            $step++; 

        }


        $this->saveHistory($monster1->id,$monster2->id,$winner->id); 
        return response()->json([
            'monster1' => $monster1->name,
            'monster1_life' => max(0, $monster1Life),
            'monster1_initial_life' => $monster1->life,

            'monster2' => $monster2->name,
            'monster2_life' => max(0, $monster2Life),
            'monster2_initial_life' => $monster2->life,

            'winner' => $winner->name,
            'winner_id' => $winner->id,

             'fightLog' => $fightLog
        ]);
    }

    public function saveHistory($f1,$f2,$w){
        $combat = new Combat(); 
        $combat->fighter_1 = $f1;
        $combat->fighter_2 = $f2;
        $combat->winner = $w;
        $combat->save();
    }

    public function history(){
        $history = Combat::with([
        'fighter1',
        'fighter2',
        'winnerMonster'
    ])->paginate(10);
        return view('history.index', compact('history'));
    }

}
