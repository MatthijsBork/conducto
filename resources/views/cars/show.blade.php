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
                    @foreach ($car->images as $index => $carImage)
                        <div class="relative group cursor-pointer">
                            <img src="{{ asset('images/cars/' . $car->id . '/' . $carImage->img) }}"
                                alt="Image {{ $index }}"
                                class="w-full h-40 object-cover rounded-md transition duration-300 transform hover:scale-105">
                            <div
                                class="hidden group-hover:flex fixed w-1/2 h-1/2 z-10">
                                <img src="{{ asset('images/cars/' . $car->id . '/' . $carImage->img) }}"
                                    alt="Image {{ $index }}" class="max-w-full max-h-full">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex md:flex-row flex-col md:w-1/2 justify-between">
                    <div class="w-full flex flex-col gap-5 px-4 justify-between">
                        <div>
                            <h2 class="text-3xl font-semibold">
                                {{ $car->title }}
                            </h2>
                            <hr class="my-3">
                            <p>{{ $car->description }}</p>
                            <hr class="my-3">
                            <h2 class="text-xl font-semibold">€{{ $car->price }}</h2>
                            <p class="my-4">
                                <x-primary-link
                                    href="{{ route('cars.respond', compact('car')) }}">Reageren</x-primary-link>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-3">
        <h2 class="text-lg font-semibold mb-2">Over deze auto</h2>
        <div class="flex flex-row gap-5">
            <div class="flex flex-col">
                <b>Merk:</b>
                <b>Jaar:</b>
                <b>Kilometerstand:</b>
                <b>Kenteken:</b>
                <b>Laatste APK:</b>
            </div>
            <div class="flex flex-col">
                <p>{{ $car->brand->name }}</p>
                <p>{{ $car->year }}</p>
                <p>{{ $car->mileage }}</p>
                <p>{{ $car->plate }}</p>
                <p>{{ $car->mot }}</p>
            </div>
        </div>
        <hr class="my-3">

        <h2 class="text-lg font-semibold mb-2">Specificaties</h2>
        <div class="flex flex-row gap-5">
            <div class="mb-4">
                @if (isset($car->properties[0]))

                    @foreach ($car->properties as $property)
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
