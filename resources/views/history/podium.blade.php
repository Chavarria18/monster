<style>
    .podium {
    max-width: 900px;
    margin: 30px auto 50px;
    text-align: center;
}



.podium-container {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    gap: 20px;
}

.podium-place {
    width: 200px;
    padding: 20px;
    border: 2px solid #5a3d24;
    border-radius: 10px;
    background: #f5e6c8;
    color: #3b2616;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
}

.podium-monster {
    width: 150px;
    height: 150px;
    margin: auto;
}

.podium-monster img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.podium-position {
    font-size: 35px;
    margin-top: 10px;
}

.podium-place h3 {
    margin: 8px 0;
}

.podium-place span {
    font-weight: bold;
}


.place-1 {
    min-height: 320px;
}

.place-2 {
    min-height: 280px;
}

.place-3 {
    min-height: 240px;
}
</style>


<div class="podium">

    <h2>Podium</h2>

    <div class="podium-container">

        @foreach ($topWinners as $index => $winner)

            <div class="podium-place place-{{ $index + 1 }}">

                <div class="podium-monster">

                    @if ($winner->winnerMonster?->image)
                        <img
                            src="{{ asset('storage/' . $winner->winnerMonster->image) }}"
                            alt="{{ $winner->winnerMonster->name }}"
                        >
                    @endif

                </div>

                <div class="podium-position">
                    @if ($index === 0)
                        🥇
                    @elseif ($index === 1)
                        🥈
                    @else
                        🥉
                    @endif
                </div>

                <h3>
                    {{ $winner->winnerMonster->name ?? 'Deleted monster' }}
                </h3>

                <span>
                    {{ $winner->wins }} {{ $winner->wins === 1 ? 'win' : 'wins' }}
                </span>

            </div>

        @endforeach

    </div>
</div>