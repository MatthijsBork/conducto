<x-dashboard-layout>
    @csrf

    <x-slot name="titleSlot">
        <p>{{ $car->title }}</p>
    </x-slot>

    <x-car-tab-menu :car="$car"></x-car-tab-menu>

    <h2 class="mb-4 text-xl font-semibold">Specificaties bewerken</h2>
    <form method="POST" action="{{ route('dashboard.cars.properties.update', compact('car')) }}"
        enctype="multipart/form-data">
        @csrf

        <div class="tab-content">
            @foreach ($car::getAllProperties() as $property)
                <div class="mb-4">
                    <x-input-label for="{{ $property->name }}">{{ $property->name }}</x-input-label>
                    <input type="text" id="{{ $property->name }}" name="properties[{{ $property->id }}]"
                        value="{{ $property->value($car->id) }}"
                        class="px-1 py-1 rounded-lg focus:outline-none focus:ring focus:ring-blue-400 focus:border-blue-400">
                </div>
            @endforeach
        </div>

        <div class="text-right">
            <a class="text-red-500 hover:underline mr-4"
                href="{{ route('dashboard.cars.properties', compact('car')) }}">Annuleren</a>
            <x-primary-button type="submit">Opslaan</x-primary-button>
        </div>
    </form>
    </div>














</x-dashboard-layout>
