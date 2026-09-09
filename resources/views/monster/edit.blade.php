<x-app>

    <x-slot:title>
        Edit monster
    </x-slot:title>

    <div class="container">

        @include('monster.form', [
            'action' => route('monster.update', $monster),
            'method' => 'PUT',
            'buttonText' => 'Guardar Cambios',
            'monster' => $monster
        ])

    </div>

</x-app>