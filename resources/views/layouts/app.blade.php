<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>
            <x-slot name="title">Semua Produk</x-slot>
        </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap) -->
        <link href="{{asset('vendor/sb-admin-2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('vendor/bootstrap.min.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body class="font-sans antialiased">
        @include('sweetalert::alert')
        <div class="min-h-screen bg-gray-100">
            {{-- @include('layouts.navigation') --}}
            <x-header.navigation />

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <x-header.footer/>
        </div>
        <script src="{{asset('vendor/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/jquery.easing.min.js')}}"></script>
        <script src="{{asset('vendor/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('vendor/sb-admin-2.js')}}"></script>
    </body>
</html>
