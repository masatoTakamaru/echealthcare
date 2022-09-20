<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('favicon.ico') }}" id="favicon">
        <title>管理者</title>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="w-full min-h-screen bg-gray-100">
            @if(Auth::id())
                @include('layouts.navigation')
            @endif
            <!-- error -->
            @if ($errors->any())
                <div class="text-red-400 p-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- flash -->
            @if (session('flashmessage'))
                <div id="flash-message" class="flex justify-between items-center p-3 bg-blue-500 opacity-90 shadow">
                    <p class="text-white">{{ session('flashmessage') }}</p>
                    <img class="h-6 w-6 mr-6" src="{{ asset('icons/ui/cancel-white.svg') }}">
                </div>
            @endif
            <!-- Page Content -->
            <main class="max-w-6xl p-4 ml-auto mr-auto">
                {{ $slot }}
            </main>
        </div>
    <script src="{{ asset('js/function.js') }}"></script>
    </body>
</html>
