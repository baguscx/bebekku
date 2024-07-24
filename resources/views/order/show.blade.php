<x-app-layout>
    <x-header.banner>
        <x-slot name="title">
            Transaction Page
        </x-slot>
        <x-slot name="description">
            Here is your transaction details:
        </x-slot>
    </x-header.banner>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Personal Details
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Nama Pembeli: {{$user->name}}</li>
                            <li class="list-group-item">Email: {{$user->email}}</li>
                            <li class="list-group-item">No HP: {{$user->phone}}</li>
                            <li class="list-group-item">Alamat: {{$user->address}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Produk Details
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Transaction ID: {{ $transaction->id }}</li>
                            <li class="list-group-item">Nama Barang: {{ $transaction->product->name }}</li>
                            <li class="list-group-item">Harga Satuan: Rp. {{ $transaction->product->price }}</li>
                            <li class="list-group-item">Jumlah Pembelian: {{ $transaction->quantity }}</li>
                            <li class="list-group-item">Total: Rp. {{ $transaction->total }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Status
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Produk Sedang dikemas</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Bukti Pengiriman
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img src="{{ asset('storage/' . $transaction->proof_of_payment) }}" alt="Bukti Pengiriman" class="img-fluid">
                                <form action="{{ route('order.upload', $transaction->id) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="proof_of_payment">Upload Bukti Pengiriman</label>
                                        <input type="file" class="form-control" name="photo" id="photo">
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
