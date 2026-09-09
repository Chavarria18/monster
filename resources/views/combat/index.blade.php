<x-app>

    <style>
        .battle-arena {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
        }

        .monster {
            width: 300px;
            text-align: center;
        }

        .monster img {
            width: 250px;
            height: 250px;
            object-fit: contain;
        }

        .monster1 {
            align-self: flex-end;
        }

        .monster2 {
            align-self: flex-start;
        }

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

        #battle-message {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 20px;
        }

        .fight-button {
            display: block;
            margin: 20px auto;
            padding: 10px 25px;
            font-size: 18px;
            cursor: pointer;
        }

        .loser {
            filter: grayscale(100%);
            opacity: 0.6;
            transition: filter 0.5s ease, opacity 0.5s ease;
        }
    </style>

    <x-slot:title>
        Combat
    </x-slot:title>

    <div class="battle-arena">


        <div id="monster1" class="monster monster1">

            <h2 id="monster1-name">
                {{ $combats[0]->name }}
            </h2>

            <div class="health-bar">
                <div id="monster1-health"></div>
            </div>

            <img src="{{ asset('storage/' . $combats[0]->image) }}" alt="{{ $combats[0]->name }}">

        </div>



        <div id="monster2" class="monster monster2">

            <h2 id="monster2-name">
                {{ $combats[1]->name }}
            </h2>

            <div class="health-bar">
                <div id="monster2-health"></div>
            </div>

            <img src="{{ asset('storage/' . $combats[1]->image) }}" alt="{{ $combats[1]->name }}">

        </div>

    </div>


    <div id="battle-message"></div>

    <button class="fight-button" id="fight-button" onclick="startFight({{ $combats[0]->id }}, {{ $combats[1]->id }})">
        ⚔️ Start Fight
    </button>


</x-app>


<script>
    async function startFight(id1, id2) {

        //Condiciones iniciales
        document.getElementById("monster2").classList.remove("loser");
        document.getElementById("monster1").classList.remove("loser");

        document.getElementById("monster1-health").style.width = "100%";
        document.getElementById("monster2-health").style.width = "100%";

        const fightButton = document.getElementById("fight-button");


        fightButton.disabled = true;
        fightButton.textContent = "⚔️ Fighting...";

        try {
            const response = await fetch(`/fight/${id1}/${id2}`);
            const fight = await response.json();

            for (const turn of fight.fightLog) {

                const attacker = document.getElementById(
                    turn.attacker === 1 ? "monster1" : "monster2"
                );

                const defender = document.getElementById(
                    turn.defender === 1 ? "monster1" : "monster2"
                );

                document.getElementById("battle-message").textContent =
                    `${attacker.querySelector("h2").textContent} deals ${turn.damage} damage!`;

                attacker.classList.add("attack");

                await sleep(500);

                attacker.classList.remove("attack");

                defender.classList.add("hit");

                await sleep(300);

                defender.classList.remove("hit");

                updateHealth(
                    turn.monster1Life,
                    turn.monster2Life,
                    fight.monster1_initial_life,
                    fight.monster2_initial_life
                );

                await sleep(1000);
            }

            document.getElementById("battle-message").textContent =
                `${fight.winner} wins!`;


            if (fight.winner_id == id1) {
                document.getElementById("monster2").classList.add("loser");
            } else {
                document.getElementById("monster1").classList.add("loser");
            }

        } finally {

            fightButton.disabled = false;
            fightButton.textContent = "⚔️ Fight";
        }
    }

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }


    function updateHealth(life1, life2, maxLife1, maxLife2) {

        const percentage1 = (life1 / maxLife1) * 100;
        const percentage2 = (life2 / maxLife2) * 100;

        const health1 = document.getElementById("monster1-health");
        const health2 = document.getElementById("monster2-health");

        health1.style.width = percentage1 + "%";
        health2.style.width = percentage2 + "%";
    }
</script>