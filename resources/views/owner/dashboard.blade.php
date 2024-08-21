<x-app-layout>
    <x-slot name="title">Dashboard Owner</x-slot>
    <x-header.banner>
        <x-slot name="title">Halo, {{Auth::user()->name}}👋</x-slot>
        <x-slot name="description">Berhasil Login Sebagai Owner</x-slot>
    </x-header.banner>
</x-app-layout>
