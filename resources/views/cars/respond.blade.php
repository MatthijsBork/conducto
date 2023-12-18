    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Vehiculum</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                <div class="container py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    @if (session('success'))
                        <div class="relative px-4 py-3 my-3 text-green-700 bg-green-100 border border-green-400 rounded"
                            role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="relative px-4 py-3 my-3 text-red-700 bg-red-100 border border-red-400 rounded"
                            role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="justify-between md:flex">
                        <div class="w-full md:w-1/6 lg:w-1/5">
                            @if (isset($menuSlot))
                                {{ $menuSlot }}
                            @else
                                <x-filter-menu></x-filter-menu>
                            @endif
                        </div>
                        <div class="w-full md:w-3/4">
                            <div class="w-full">
                                <div class="mb-2 flex items-center justify-between">
                                    <div class="flex-shrink-0">
                                        <h1 class="text-2xl font-semibold">Reageren op {{ $car->title }}</h1>
                                    </div>
                                </div>
                                <div class="p-6 overflow-x-auto bg-white shadow-sm sm:rounded-lg">
                                    <form method="POST" action="{{ route('cars.respond.post', compact('car')) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="tab-content">
                                            <div class="mb-4">
                                                <x-input-label for="name">Naam</x-input-label>
                                                <input type="text" id="name" name="name"
                                                    value="{{ old('name') }}"
                                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                                @error('name')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <x-input-label for="email">Uw E-mailadres</x-input-label>
                                                <input type="text" id="email" name="email"
                                                    value="{{ old('email') }}"
                                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                                                @error('email')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <x-input-label for="message">Bericht</x-input-label>
                                                <textarea id="message" name="message" style="height: 250px;"
                                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">{{ old('message') }}</textarea>
                                                @error('message')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <a class="text-red-500 hover:underline mr-4"
                                                href="javascript:history.back()">Annuleren</a>
                                            <x-primary-button type="submit">Versturen</x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>

    </html>
