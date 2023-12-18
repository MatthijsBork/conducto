<x-dashboard-layout>
    <x-slot name="titleSlot">{{ $car->title }}</x-slot>
    <h2 class="text-xl font-semibold mb-4">Informatie bewerken</h2>
    <x-car-form :action="route('dashboard.cars.update', compact('car'))" :car="$car" :brands="$brands"></x-car-form>
</x-dashboard-layout>
