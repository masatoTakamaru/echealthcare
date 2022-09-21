<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('favicon.ico') }}" id="favicon">
        <title>管理者</title>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
         <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
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
