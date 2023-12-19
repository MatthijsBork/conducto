<x-dashboard-layout>
    @csrf

    <x-slot name="titleSlot">
        <p>{{ $house->address . ', ' . $house->city }}</p>
    </x-slot>

    <x-slot name="buttonSlot">
        <x-primary-link href="{{ route('user.houses.images.edit', compact('house')) }}">Foto's bewerken</x-primary-link>
    </x-slot>

    <x-slot name="menuSlot">
        <x-user-menu></x-user-menu>
    </x-slot>

    <x-house-tab-menu :house="$house"></x-house-tab-menu>

    <div class="p-6 text-gray-900">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            {{-- @foreach ($houseImages as $index => $houseImage)
                <div class="relative group cursor-pointer">
                    <img src="{{ asset('images/houses/' . $house->id . '/' . $houseImage->img) }}"
                        alt="Image {{ $index }}"
                        class="w-full h-40 object-cover rounded-md transition duration-300 transform hover:scale-105">
                    <div
                        class="hidden group-hover:flex fixed w-1/2 h-1/2 bg-black bg-opacity-75 items-center justify-center">
                        <img src="{{ asset('images/houses/' . $house->id . '/' . $houseImage->img) }}"
                            alt="Image {{ $index }}" class="max-w-full max-h-full">
                    </div>
                </div>
            @endforeach --}}
        </div>
    </div>
</x-dashboard-layout>
