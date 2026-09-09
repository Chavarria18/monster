<x-app>
    <x-slot:title>
        Create monster
    </x-slot:title>



 
    <div class="container">

        @include('monster.form', [
            'action' => route('monster.store'),
            'method' => 'POST',
            'buttonText' => 'Crear Monstruo',
            'monster' => null
        ])

       
    </div>


</x-app>