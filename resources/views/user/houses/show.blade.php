<x-show-layout>
    @csrf

    <x-slot name="titleSlot">
        <a class="text-red-500 hover:underline mr-4" href="javascript:history.back()">
            < Terug </a>
    </x-slot>

    <div class="p-2">
        <div class="flex md:flex-row w-full flex-col-reverse justify-between">
            <div class="flex md:flex-row flex-col w-full justify-between">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    {{-- @foreach ($house->images as $index => $houseImage)
                        <div class="relative group cursor-pointer">
                            <img src="{{ asset('images/houses/' . $house->id . '/' . $houseImage->img) }}"
                                alt="Image {{ $index }}"
                                class="w-full h-40 object-cover rounded-md transition duration-300 transform hover:scale-105">
                            <div class="hidden group-hover:flex fixed w-1/2 h-1/2 z-10">
                                <img src="{{ asset('images/houses/' . $house->id . '/' . $houseImage->img) }}"
                                    alt="Image {{ $index }}" class="max-w-full max-h-full">
                            </div>
                        </div>
                    @endforeach --}}
                </div>
                <div class="flex md:flex-row flex-col md:w-1/2 justify-between">
                    <div class="w-full flex flex-col gap-5 px-4 justify-between">
                        <div>
                            <h2 class="text-3xl font-semibold">
                                {{ $house->address . ', ' . $house->city }}
                            </h2>
                            <hr class="my-3">
                            <p>{{ $house->description }}</p>
                            <hr class="my-3">
                            <h2 class="text-xl font-semibold">€{{ $house->rent }} / Maand</h2>
                            <p class="my-4">
                                <x-primary-link
                                    href="{{ route('houses.respond', compact('house')) }}">Reageren</x-primary-link>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-3">
        <h2 class="text-lg font-semibold mb-2">Over deze woning</h2>
        <div class="flex flex-row gap-5">
            <div class="flex flex-col">
                <b>Adres:</b>
                <b>Stad:</b>
                <b>Huur:</b>
            </div>
            <div class="flex flex-col">
                <p>{{ $house->address }}</p>
                <p>{{ $house->city }}</p>
                <p>€{{ $house->rent }}</p>
            </div>
        </div>
        <hr class="my-3">

        <h2 class="text-lg font-semibold mb-2">Specificaties</h2>
        <div class="flex flex-row gap-5">
            <div class="mb-4">
                @if (isset($house->properties[0]))

                    @foreach ($house->properties as $property)
                        <div class="flex flex-row gap-5">
                            <div class="flex flex-col">
                                <b>{{ $property->property->name }}:</b>
                            </div>
                            <div class="flex flex-col">
                                <p>{{ $property->value }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    Er zijn nog geen specificaties ingevuld
                @endif
            </div>
        </div>
    </div>
</x-show-layout>
