<x-layout>
    @csrf

    <x-slot name="titleSlot">
        <p>{{ $house->address . ', ' . $house->city }}</p>
    </x-slot>

    <x-slot name="menuSlot">
        <x-user-menu></x-user-menu>
    </x-slot>

    <x-slot name="buttonSlot">
        <x-primary-link href="{{ route('user.houses.edit', compact('house')) }}">Informatie bewerken</x-primary-link>
    </x-slot>

    <x-house-tab-menu :house="$house"></x-house-tab-menu>
    <div class="p-6 text-gray-900">
        <div class="flex md:flex-row w-full flex-col-reverse justify-between">
            <div class="flex flex-col w-full">
                <div class="flex flex-row justify-between">
                    <p>
                        <x-input-label>Beschrijving</x-input-label>
                        {{ $house->description }}
                    </p>
                </div>
                <hr class="my-3">
                <div class="flex flex-row gap-5">
                    <div class="flex flex-col">
                        <b>Merk:</b>

                    </div>
                    <div class="flex flex-col">
                        <p>{{ $house->address }}</p>

                    </div>
                </div>
            </div>


        </div>
    </div>
</x-layout>
