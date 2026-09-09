<x-app>

    <x-slot:title>
        Monsters
    </x-slot:title>
    <style>
        .cards {
            max-width: 1000px;
            margin: 1em auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 20px;
        }

        .card {
            border: 1px solid #999;
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }


        .card footer {
            background-color: #5a3d24;
            color: white;
            text-align: center;
            padding: 8px 12px;
            line-height: 1.2;
        }

        /* Button spacing */
        .card .tavern-btn {
            margin: 12px;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 260px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f5f5;
            padding: 10px;
            overflow: hidden;
        }

        .image-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform .3s ease;
        }

        .stats-overlay {
            position: absolute;
            inset: 0;
            background: rgba(35, 22, 10, 0.85);
            color: #f8e9c9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            opacity: 0;
            transition: opacity .3s ease;
            gap: 6px;
        }

        .card:hover .stats-overlay {
            opacity: 1;
        }

        .card:hover .image-container img {
            transform: scale(1.05);
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
        }

        .action-buttons .tavern-btn {
            margin: 0;
        }
    </style>


    <div class="content-layout">

        <div class="monsters-content">

            <form action="{{ route('combat.index') }}" method="GET" id="combat-form">

                <div class="action-buttons">
                    <a href="/monster/create" class="tavern-btn">
                        ➕ Create
                    </a>

                    <button type="submit" class="tavern-btn">
                        ⚔️ Combat
                    </button>

                    <button type="button" id="clear-selection" class="tavern-btn">
                        🧹 Clear
                    </button>
                </div>

                <div class="cards">

                    @foreach ($monsters as $monster)
                        <div class="card">

                            <div class="image-container">
                                @if ($monster->image && Storage::disk('public')->exists($monster->image))
                                    <img src="{{ asset('storage/' . $monster->image) }}" alt="{{ $monster->name }}">
                                @else
                                    <div class="image-placeholder">
                                        No image
                                    </div>
                                @endif

                                <div class="stats-overlay">
                                    <ul>
                                        <li>❤️ Vida: {{ $monster->life }}</li>
                                        <li>⚔️ Ataque: {{ $monster->atack }}</li>
                                        <li>🛡️ Defensa: {{ $monster->defense }}</li>
                                        <li>💨 Velocidad: {{ $monster->velocity }}</li>
                                    </ul>
                                </div>
                            </div>

                            <footer>
                                {{ $monster->name }}

                                <a href="{{ route('monster.edit', $monster->id) }}" class="tavern-btn" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <input type="checkbox" class="monster-checkbox" value="{{ $monster->id }}">
                            </footer>

                        </div>
                    @endforeach

                </div>

            </form>

            {{ $monsters->links() }}

        </div>

      

    </div>



</x-app>

<script>

    //Almacenar id de otras paginas 
    const STORAGE_KEY = 'selectedMonsters';

    let selectedMonsters = JSON.parse(sessionStorage.getItem(STORAGE_KEY)) || [];

    document.querySelectorAll('.monster-checkbox').forEach(checkbox => {

        if (selectedMonsters.includes(checkbox.value)) {
            checkbox.checked = true;
        }

        checkbox.addEventListener('change', function () {

            if (this.checked) {


                if (selectedMonsters.length >= 2) {
                    this.checked = false;
                    alert('You can only select 2 monsters.');
                    return;
                }

                selectedMonsters.push(this.value);

            } else {

                selectedMonsters =
                    selectedMonsters.filter(id => id !== this.value);
            }

            sessionStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(selectedMonsters)
            );
        });
    });
    //Enviar los ids 
    document.getElementById('combat-form').addEventListener('submit', function (event) {

        const selected =
            JSON.parse(sessionStorage.getItem('selectedMonsters')) || [];

        if (selected.length !== 2) {
            event.preventDefault();
            alert('Select exactly 2 monsters.');
            return;
        }

        selected.forEach(id => {

            const input = document.createElement('input');

            input.type = 'hidden';
            input.name = 'monsters[]';
            input.value = id;

            this.appendChild(input);
        });
    });
    //Limpia la seleccion
    document.getElementById('clear-selection').addEventListener('click', function () {
        selectedMonsters = [];

        sessionStorage.removeItem('selectedMonsters');

        document.querySelectorAll('.monster-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
    });

</script>