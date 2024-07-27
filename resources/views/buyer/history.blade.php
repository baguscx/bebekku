<x-app-layout>
    <x-slot name="title">History</x-slot>
    <x-header.banner>
        <x-slot name="title">
            Transaction History
        </x-slot>
        <x-slot name="description">
            Here is your transaction history
        </x-slot>
    </x-header.banner>
    <div class="container my-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
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
