<x-dashboard-layout>
    @csrf

    <x-slot name="titleSlot">
        <p>{{ $car->title }}</p>
    </x-slot>

    <x-slot name="buttonSlot">
        <x-primary-link href="{{ route('dashboard.cars.properties.edit', compact('car')) }}">Specificaties bewerken</x-primary-link>
    </x-slot>

    <x-car-tab-menu :car="$car"></x-car-tab-menu>

    <div class="p-6 text-gray-900">
        <div class="flex md:flex-row w-full flex-col-reverse justify-between">
            <div>
                <h2 class="text-xl mb-2 font-bold">Specificaties</h2>
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
    </div>
</x-dashboard-layout>
