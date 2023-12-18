<x-layout>
    <x-slot name="titleSlot">Auto toevoegen</x-slot>
    <x-car-form :action="route('user.cars.store')" :brands="$brands"></x-car-form>
</x-layout>
