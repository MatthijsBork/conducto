<div class="w-full p-4 mx-0 mb-3 bg-white shadow-sm sm:rounded-lg text-decoration-none">
    <h2 class="mb-4 text-lg font-semibold">Dashboard menu</h2>
    <ul>
        <li class="mb-2">
            <x-button-link href="{{ route('dashboard.cars') }}" :active="request()->routeIs('dashboard.cars*')">Auto's</x-button-link>
        </li>
        <li class="mb-2">
            <x-button-link href="{{ route('dashboard.properties') }}" :active="request()->routeIs('dashboard.properties*')">Eigenschappen</x-button-link>
        </li>
        <li class="mb-2">
            <x-button-link href="{{ route('dashboard.brands') }}" :active="request()->routeIs('dashboard.brands*')">Merken</x-button-link>
        </li>
        <li class="mb-2">
            <x-button-link href="{{ route('dashboard.users') }}" :active="request()->routeIs('dashboard.users*')">Gebruikers</x-button-link>
        </li>
    </ul>
</div>
