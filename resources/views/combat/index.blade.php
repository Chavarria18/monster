<x-app>
    <style>
        .health-bar {
            width: 300px;
            height: 30px;
            background-color: #333;
            border: 2px solid black;
            border-radius: 5px;
            overflow: hidden;
        }

        .health-bar>div {
            height: 100%;
            width: 100%;
            transition: width 0.3s ease;
            background-color: red;
        }

        .attack {
            animation: attack 0.5s;
        }

        .hit {
            animation: hit 0.3s;
        }

        @keyframes attack {
            50% {
                transform: translateX(50px);
            }
        }

        @keyframes hit {
            25% {
                transform: translateX(-10px);
            }

            50% {
                transform: translateX(10px);
            }

            75% {
                transform: translateX(-10px);
            }
        }
    </style>
    <x-slot:title>
        Combat
    </x-slot:title>
    <div id="monster1">
        <h2 id="monster1-name"></h2>
        <div class="health-bar">
            <div id="monster1-health"></div>
        </div>
    </div>

    <div id="monster2">
        <h2 id="monster2-name"></h2>
        <div class="health-bar">
            <div id="monster2-health"></div>
        </div>
    </div>
    <div id="battle-message"></div>
    <button onclick="startFight(1, 2)">
        Start Fight
    </button>
</x-app>
<script>
    async function startFight(id1, id2) {

        const response = await fetch(`/fight/${id1}/${id2}`);
        const fight = await response.json();
        console.log(fight)

        document.getElementById("monster1-name").textContent =
            fight.monster1;

        document.getElementById("monster2-name").textContent =
            fight.monster2;

        for (const turn of fight.fightLog) {

            const attacker = document.getElementById(
                turn.attacker === 1 ? "monster1" : "monster2"
            );

            const defender = document.getElementById(
                turn.defender === 1 ? "monster1" : "monster2"
            );

            // Attack animation
            attacker.classList.add("attack");

            await sleep(500);

            // Remove attack animation
            attacker.classList.remove("attack");

            // Damage animation
            defender.classList.add("hit");

            await sleep(300);

            defender.classList.remove("hit");

            // Update health
            updateHealth(
                turn.monster1Life,
                turn.monster2Life,
                fight.monster1_initial_life,
                fight.monster2_initial_life
            );

            // Show damage
            document.getElementById("battle-message").textContent =
                `${attacker.querySelector("h2").textContent} deals ${turn.damage} damage!`;

            await sleep(1000);
        }

        document.getElementById("battle-message").textContent =
            `${fight.winner} wins!`;
    }

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    function updateHealth(life1, life2, maxLife1, maxLife2) {

        const percentage1 = (life1 / maxLife1) * 100;
        const percentage2 = (life2 / maxLife2) * 100;
        console.log("Life 1:", life1, "Percentage:", percentage1);
        console.log("Life 2:", life2, "Percentage:", percentage2);
        const health1 = document.getElementById("monster1-health");
        const health2 = document.getElementById("monster2-health");
        health1.style.width = percentage1 + "%";
        health2.style.width = percentage2 + "%";
    }

</script>