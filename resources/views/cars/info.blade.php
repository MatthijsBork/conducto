<x-dashboard-layout>
    @csrf

    <x-slot name="titleSlot">
        <p>{{ $car->title }}</p>
    </x-slot>

    <x-slot name="buttonSlot">
        <x-primary-link href="{{ route('dashboard.cars.edit', compact('car')) }}">Informatie bewerken</x-primary-link>
    </x-slot>

    <x-car-tab-menu :car="$car"></x-car-tab-menu>
    <div class="p-6 text-gray-900">
        <div class="flex md:flex-row w-full flex-col-reverse justify-between">
            <div class="flex flex-col w-full">
                <div class="flex flex-row justify-between">
                    <p>
                        <x-input-label>Beschrijving</x-input-label>
                        {{ $car->description }}
                    </p>
                </div>
                <hr class="my-3">
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
            </div>


        </div>
    </div>
</x-dashboard-layout>
