<x-layout>


    <x-slot name="titleSlot">Aanbod</x-slot>

    <x-slot name="searchSlot">
        <x-search :action="null"></x-search>
    </x-slot>

    <x-slot name="noBackgroundSlot">
        @if (!isset($houses[0]))
            <div class="w-full p-10 text-center bg-white rounded-lg">
                <h1 class="text-xl font-bold text-blue-500">Veel leegte...</h1>
                <p class="mb-4">Er zijn geen woningen gevonden</p>
            </div>
        @else
            @foreach ($houses as $house)
                test
            @endforeach

        @endif
        <div class="my-4">
            {{ $houses->links() }}
        </div>
    </x-slot>
</x-layout>
