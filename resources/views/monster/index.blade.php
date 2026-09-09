<x-app>
    <x-slot:title>
       monster
    </x-slot:title>
 <ul>
        @foreach ($monsters as $monster)
            <li>{{ $monster->name }}</li>
        @endforeach
    </ul>
</x-app>