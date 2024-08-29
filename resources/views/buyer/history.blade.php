<x-app-layout>
    <x-slot name="title">History</x-slot>
    <x-header.banner>
        <x-slot name="title">
            Riwayat Transaksi
        </x-slot>
        <x-slot name="description">
            Disini adalah riwayat transaksi Anda:
        </x-slot>
    </x-header.banner>
    <div class="container my-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Banyaknya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>
                        {{ $transaction->product->name }}
                    </td>
                    <td>
                        <span class="badge badge-primary">{{ $transaction->quantity }} items</span>
                    </td>
                    <td>
                        <span class="badge {{$transaction->status=='success' ? 'badge-success' : 'badge-secondary'}}">{{ $transaction->status }}</span>
                    </td>
                    <td>
                        <a href="{{ route('transaction', $transaction->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
