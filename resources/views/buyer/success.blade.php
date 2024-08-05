<x-app-layout>
    <x-slot name="title">Pembayaran Success</x-slot>
    <x-header.banner>
        <x-slot name="title">
            Transaksi Berhasil ✅
        </x-slot>
        <x-slot name="description">
            Transaksi kamu berhasil. Halaman ini akan dialihkan dalam <span id="countdown">5</span> detik.
            <script>
                // Countdown timer
                var count = 5;

                var x = setInterval(function() {
                    document.getElementById("countdown").innerHTML = count + " ";

                    count--;

                    if (count < 0) {
                        clearInterval(x);
                        window.location.href = "{{ route('buyer.order') }}"; // Ganti 'your_route_name' dengan nama rute yang sebenarnya
                    }
                }, 1000);
            </script>
        </x-slot>
    </x-header.banner>
</x-app-layout>
