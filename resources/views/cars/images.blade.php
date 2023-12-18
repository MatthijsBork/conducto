<x-dashboard-layout>
    @csrf

    <x-slot name="titleSlot">
        <p>{{ $car->title }}</p>
    </x-slot>

    <x-slot name="buttonSlot">
        <x-primary-link href="{{ route('dashboard.cars.images.edit', compact('car')) }}">Foto's bewerken</x-primary-link>
    </x-slot>

    <x-car-tab-menu :car="$car"></x-car-tab-menu>

    <div class="p-6 text-gray-900">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($carImages as $index => $carImage)
                <div class="relative group cursor-pointer">
                    <img src="{{ asset('images/cars/' . $car->id . '/' . $carImage->img) }}"
                        alt="Image {{ $index }}"
                        class="w-full h-40 object-cover rounded-md transition duration-300 transform hover:scale-105">
                    <div
                        class="hidden group-hover:flex fixed w-1/2 h-1/2 bg-black bg-opacity-75 items-center justify-center">
                        <img src="{{ asset('images/cars/' . $car->id . '/' . $carImage->img) }}"
                            alt="Image {{ $index }}" class="max-w-full max-h-full">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>
