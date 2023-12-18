<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js">
        window.addEventListener('load', () => {
            for (const name of ['content', 'intro']) {
                ClassicEditor.create(document.getElementById(name))
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    </script>
</head>

<body class="p-4 bg-gray-100">
    <div class="py-4 text-left">
        <h1 class="text-3xl font-bold">Vehiculum.</h1>
    </div>
    <div class="flex-row">
        <div class="xl:flex-row">
            <div class="container p-6 mx-auto mt-4 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-2xl font-semibold">Reactie op uw auto</h2>
                <p class="mb-4">Iemand heeft gereageerd op uw auto</p>
                <p class="mb-2"><b>Reageerder: </b>{{ $data->name }}</p>
                <p class="mb-4"><b>Reageerder E-mail: </b>{{ $data->email }}</p>

                <div class="flex flex-row mt-5">
                    <div class="my-1 mr-2">
                        <h1 class="text-lg font-bold">Bericht van reageerder</h1>
                        <p>{{ $data->message }}</p>
                    </div>
                </div>
                <div class="flex flex-row mt-5">
                    <div class="my-1 mr-2">
                        <h1 class="text-lg font-bold">Auto</h1>
                        <p>
                        <p>Titel: {{ $car->title }}</p>
                        <p>Kilometerstand: {{ $car->mileage }}</p>
                        <p>Prijs: {{ $car->price }}</p>
                        <p>Laatste APK:
                            {{ date('j F Y', strtotime($car->mot)) }}
                        </p>
                        </p>
                    </div>
                </div>
                <div class="flex flex-row mt-5">
                    <div class="my-1 mr-2">
                        <h1 class="text-lg font-bold">Beschrijving</h1>
                        <p>
                            {!! $car->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
