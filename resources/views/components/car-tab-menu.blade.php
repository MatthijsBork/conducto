@if (request()->routeIs('dashboard.cars*'))
    <div class="mb-4">
        <x-nav-link class="pb-3" :href="route('dashboard.cars.info', compact('car'))" :active="request()->routeIs('dashboard.cars.info*')">
            Informatie
        </x-nav-link>
        <x-nav-link class="pb-3" :href="route('dashboard.cars.properties', compact('car'))" :active="request()->routeIs('dashboard.cars.properties*')">
            Specificaties
        </x-nav-link>
        <x-nav-link class="pb-3" :href="route('dashboard.cars.images', compact('car'))" :active="request()->routeIs('dashboard.cars.images*')">
            Foto's
        </x-nav-link>
        <hr>
    </div>
@else
    <div class="mb-4">
        <x-nav-link class="pb-3" :href="route('user.cars.info', compact('car'))" :active="request()->routeIs('user.cars.info*')">
            Informatie
        </x-nav-link>
        <x-nav-link class="pb-3" :href="route('user.cars.properties', compact('car'))" :active="request()->routeIs('user.cars.properties*')">
            Specificaties
        </x-nav-link>
        <x-nav-link class="pb-3" :href="route('user.cars.images', compact('car'))" :active="request()->routeIs('user.cars.images*')">
            Foto's
        </x-nav-link>
        <hr>
    </div>
@endif
