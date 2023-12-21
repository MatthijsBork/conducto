<x-layout>
    <x-slot name="menuSlot">
        <x-user-menu></x-user-menu>
    </x-slot>

    <x-slot name="titleSlot">Woning toevoegen</x-slot>

    <x-respond-form :houses="$houses"></x-respond-form>
</x-layout>
