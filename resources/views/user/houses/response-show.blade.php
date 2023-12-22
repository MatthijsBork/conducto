<x-show-layout>

    <x-slot name="titleSlot">
        <a class="text-blue-500 hover:underline" href="{{ route('user.houses.responses', compact('house')) }}">
            < Terug</a>
    </x-slot>

    <div class="p-2">
        <div class="flex md:flex-row justify-between w-full flex-col-reverse">
            <h1 class="text-xl font-semibold">Reactie op
                {{ $house_response->house->address . ', ' . $house_response->house->city }}</h1>
            <div>
                @if ($house->acceptedResponse() == null)
                    <x-primary-link class="bg-green-600 hover:bg-green-700"
                        href="{{ route('user.houses.responses.accept', compact('house', 'house_response')) }}">Reactie
                        accepteren</x-primary-link>
                @elseif ($house->acceptedResponse()->id ?? null == $house_response->id)
                    <x-primary-link class="bg-green-100 hover:bg-green-100 border border-green-500 text-green-500">Al
                        geaccepteerd</x-primary-link>
                @else
                    <x-primary-link class="bg-gray-300 hover:bg-gray-300 border border-gray-500 text-black">Woning is
                        bezet</x-primary-link>
                @endif
                <x-primary-link class="bg-red-500 hover:bg-red-700 hover:text-white"
                    href="{{ route('user.houses.responses.decline', compact('house', 'house_response')) }}"
                    onclick="return confirm('Hiermee wordt de reactie verwijderd. Doorgaan?');">Reactie
                    afwijzen</x-primary-link>
            </div>
        </div>

        <hr class="my-3">

        <div class="flex flex-row justify-normal gap-10">
            <div class="flex flex-col">
                <p><b>Aanvrager:</b></p>
                <p><b>E-mail:</b></p>
                <p><b>Telefoonnummer:</b></p>
                <p><b>Reactie:</b></p>
            </div>
            <div class="flex flex-col">
                <p>{{ $house_response->name }}</p>
                <p>{{ $house_response->email }}</p>
                <p>{{ $house_response->telephone }}</p>
                <p>{{ $house_response->message }}</p>
            </div>
        </div>

    </div>
</x-show-layout>
