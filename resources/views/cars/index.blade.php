<x-layout>

    <x-slot name="titleSlot">Auto's</x-slot>

    <x-slot name="searchSlot">
        <x-search :action="null"></x-search>
    </x-slot>

    <x-slot name="noBackgroundSlot">
        @if (!isset($cars[0]))
            <div class="w-full p-10 text-center bg-white rounded-lg">
                <h1 class="text-xl font-bold text-blue-500">Veel leegte...</h1>
                <p class="mb-4">Er zijn geen auto's gevonden</p>
            </div>
        @else
            @foreach ($cars as $car)
                <x-car-card :car="$car"></x-car-card>
            @endforeach

        @endif
        <div class="my-4">
            {{ $cars->links() }}
        </div>
    </x-slot>
</x-layout>
