<x-dashboard-layout>
    @csrf

    <x-slot name="titleSlot">
        <p>{{ $car->title }}</p>
    </x-slot>

    <x-car-tab-menu :car="$car"></x-car-tab-menu>

    <div class="p-6 text-gray-900">
        <div class="flex md:flex-row w-full flex-col-reverse justify-between">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Your image grid items go here -->
                @foreach ($carImages as $index => $carImage)
                    <div class="relative group cursor-pointer">
                        <img src="{{ asset('images/cars/' . $car->id . '/' . $carImage->img) }}"
                            alt="Image {{ $index }}"
                            class="w-full h-40 object-cover rounded-md transition duration-300 transform hover:scale-105">
                        <div
                            class="hidden group-hover:flex fixed w-1/2 h-1/2 bg-black bg-opacity-75 items-center justify-center">
                            <img src="{{ asset('images/cars/' . $car->id . '/' . $carImage->img) }}" alt="Image {{ $index }}" class="max-w-full max-h-full">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col">
                {{-- @if (($car->img ?? null) != null)
                    <div>
                        <img id="current_image" src="{{ asset('images/companies/' . $car->id . '/' . $car->img) }}"
                            alt="Huidige Afbeelding" class="h-[400px] max-w-[400px] p-1 border-gray-400 rounded-lg">
                @endif --}}
            </div>

        </div>
    </div>
    <form method="POST" action="{{ route('dashboard.cars.images.store', compact('car')) }}"
        enctype="multipart/form-data">
        @csrf

        <x-input-label>Foto's toevoegen</x-input-label>
        <input type="file" name="images[]" multiple>
        @error('images')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div class="text-right">
            <a class="text-red-500 hover:underline mr-4"
                href="{{ route('dashboard.cars.images', compact('car')) }}">Annuleren</a>
            <x-primary-button type="submit">Opslaan</x-primary-button>
        </div>
    </form>
</x-dashboard-layout>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('carousel', () => ({
            activeItem: 0,
            totalItems: {{ count($carImages) }},

            next() {
                this.activeItem = (this.activeItem + 1) % this.totalItems;
            },

            prev() {
                this.activeItem = (this.activeItem - 1 + this.totalItems) % this.totalItems;
            },
        }));
    });
</script>
