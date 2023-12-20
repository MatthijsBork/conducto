<x-layout>
    @csrf

    <x-slot name="menuSlot">
        <x-user-menu></x-user-menu>
    </x-slot>

    <x-slot name="titleSlot">
        <p>{{ $house->address . ', ' . $house->city }}</p>
    </x-slot>

    <x-house-tab-menu :house="$house"></x-house-tab-menu>

    <div class="p-6 text-gray-900">
        <div class="flex md:flex-row w-full flex-col-reverse justify-between">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($houseImages as $index => $image)
                    <div class="relative group cursor-pointer">
                        <a class="hover:underline text-red-500"
                            onclick="return confirm('Weet u zeker dat u dit wilt verwijderen?');"
                            href="{{ route('user.houses.images.delete', compact('house', 'image')) }}">Verwijderen</a>
                        <img src="{{ asset('images/houses/' . $house->id . '/' . $image->img) }}"
                            alt="Image {{ $index }}"
                            class="w-full h-40 object-cover rounded-md transition duration-300 transform hover:scale-105">
                        <div
                            class="hidden group-hover:flex fixed w-1/2 h-1/2 bg-black bg-opacity-75 items-center justify-center">
                            <img src="{{ asset('images/houses/' . $house->id . '/' . $image->img) }}"
                                alt="Image {{ $index }}" class="max-w-full max-h-full">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('user.houses.images.store', compact('house')) }}"
        enctype="multipart/form-data">
        @csrf

        <x-input-label>Foto's toevoegen</x-input-label>
        <input type="file" name="images[]" multiple>
        @error('images')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div class="text-right">
            <a class="text-red-500 hover:underline mr-4"
                href="{{ route('user.houses.images', compact('house')) }}">Annuleren</a>
            <x-primary-button type="submit">Opslaan</x-primary-button>
        </div>
    </form>
</x-layout>
