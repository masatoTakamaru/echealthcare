<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('favicon.ico') }}" id="favicon">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="w-full min-h-screen bg-gray-100">
            @if(Auth::id())
                @include('layouts.navigation')
            @endif
            <!-- エラーメッセージの表示 -->
            @if ($errors->any())
                <div class="text-red-400 p-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- フラッシュメッセージ -->
            @if (session('flashmessage'))
                <div id="flash-message" class="flex justify-between items-center p-3 bg-blue-500 opacity-90 shadow">
                    <p class="text-white">{{ session('flashmessage') }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="flash-message-cancel" class="text-white bi bi-x-circle cursor-pointer" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
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
