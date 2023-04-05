<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @auth('web')
            <meta name="api-token" content="{{ auth()->guard('web')->user()->api_token }}">
        @endauth
        <title>{{ isset($title) ? $title.' | '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if (isset($css))
            {{$css}}
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            @if (session()->has('success'))
                <div class="bg-white shadow toRemove">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-green-800">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="bg-white shadow toRemove">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-yellow-600">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    @if(isset($js)) {{$js}} @endif
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        setTimeout(function () {
            $('.toRemove').hide()
        },2000)
    </script>
    </body>
</html>
