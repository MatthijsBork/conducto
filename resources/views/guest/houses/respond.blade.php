<x-layout>

    <x-slot name="titleSlot">Reageren op {{ $house->address . ', ' . $house->city }}</x-slot>

    <x-slot name="menuSlot">
        <x-filter-menu></x-filter-menu>
    </x-slot>

    <form method="POST" action="{{ route('houses.respond.store', compact('house')) }}" enctype="multipart/form-data">
        @csrf

        <div class="tab-content">
            <div class="mb-4">
                <x-input-label for="name">Naam</x-input-label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <x-input-label for="email">Uw E-mailadres</x-input-label>
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                @error('email')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <x-input-label for="telephone">Uw telefoonnummer</x-input-label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                @error('telephone')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <x-input-label for="message">Bericht</x-input-label>
                <textarea id="message" name="message" style="height: 250px;"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">{{ old('message') }}</textarea>
                @error('message')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="text-right">
            <a class="text-red-500 hover:underline mr-4" href="javascript:history.back()">Annuleren</a>
            <x-primary-button type="submit">Versturen</x-primary-button>
        </div>
    </form>
</x-layout>
