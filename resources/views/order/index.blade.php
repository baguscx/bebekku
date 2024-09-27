<x-app-layout>
    <x-slot name="title">Halaman Order</x-slot>
    <x-header.banner>
        <x-slot name="title">Semua Pesanan</x-slot>
        <x-slot name="description">Semua Pesanan</x-slot>
    </x-header.banner>

    <div class="container py-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Produk</th>
                    <th>Total Pembayaran</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->product->name.' ('. $order->quantity .')' }}</td>
                    <td>Rp. {{ $order->total }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if ($order->bukti_pengiriman)
                            <span class="badge badge-success">Sudah Dikirim</span>
                        @else
                            <span class="badge badge-warning">Belum Dikirim</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
