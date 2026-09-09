<x-app>
    <x-slot:title>
        Crear Monstruo
    </x-slot:title>



    @if ($errors->any())
        <div class="parchment-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">

        @include('monster.form', [
            'action' => route('monster.store'),
            'method' => 'POST',
            'buttonText' => 'Crear Monstruo',
            'monster' => null
        ])

       
    </div>


</x-app>