<?php

namespace App\Services;

use App\Models\Monster;

class CombatService
{
    public function procesFight(Monster $monster1, Monster $monster2): array
    {
        $monster1Life = $monster1->life;
        $monster2Life = $monster2->life;

        if ($monster1->velocity > $monster2->velocity) {
            $turn = 1;
        } elseif ($monster1->velocity < $monster2->velocity) {
            $turn = 2;
        } else {
            $turn = $monster1->atack >= $monster2->atack ? 1 : 2;
        }

        $fightLog = [];
        $step = 1;

        while ($monster1Life > 0 && $monster2Life > 0) {

            if ($turn === 1) {
                $damage = max(1, $monster1->atack - $monster2->defense);
                $monster2Life -= $damage;
            } else {
                $damage = max(1, $monster2->atack - $monster1->defense);
                $monster1Life -= $damage;
            }

            $fightLog[] = [
                'turn' => $step,
                'attacker' => $turn,
                'damage' => $damage,
                'monster1Life' => max(0, $monster1Life),
                'monster2Life' => max(0, $monster2Life),
            ];

            $turn = $turn === 1 ? 2 : 1;
            $step++;
        }

        return [
            'winner' => $monster1Life > 0 ? $monster1 : $monster2,
            'monster1Life' => max(0, $monster1Life),
            'monster2Life' => max(0, $monster2Life),
            'fightLog' => $fightLog,
        ];
    }
}