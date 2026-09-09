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
    </style>


    <a class="tavern-nav__link @if(request()->is('create')) is-active @endif" href="/monster/create">Create</a>
    <ul>


        <div class="cards">
            @foreach ($monsters as $monster)
                <article class="card">

                    <div class="image-container">
                        <img src="{{ asset('storage/' . $monster->image) }}" alt="{{ $monster->name }}">

                        <div class="stats-overlay">

                            <ul>
                                <p>❤️ Vida: {{ $monster->life }}</p>
                                <p>⚔️ Ataque: {{ $monster->atack }}</p>
                                <p>🛡️ Defensa: {{ $monster->defense }}</p>
                                <p>💨 Velocidad: {{ $monster->velocity }}</p>
                            </ul>

                        </div>
                    </div>

                    <footer>{{ $monster->name }}
                        <a href="{{ route('monster.edit', $monster->id) }}" class="tavern-btn" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                    </footer>



                </article>
            @endforeach
        </div>






    </ul>
</x-app>