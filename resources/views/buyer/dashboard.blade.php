<x-app-layout>
        <x-slot name="title">Dashboard</x-slot>
<x-header.banner>
    <x-slot name="title">Halo, {{Auth::user()->name}} 👋</x-slot>
    <x-slot name="description">Selamat Datang di Toko Online Kami! Temukan Produk Bebek Terbaik di Sini. Selamat Berbelanja! 🦢</x-slot>
</x-header.banner>
</x-app-layout>
