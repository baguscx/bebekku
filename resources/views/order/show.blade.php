<x-app-layout>
    <x-slot name="title">Order #{{$transaction->id}}</x-slot>
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
                            @if ($transaction->bukti_pengiriman == null)
                                <li class="list-group-item">Produk Sedang dikemas 📦</li>
                            @else
                                <li class="list-group-item">Produk Sedang dikirim ✈️</li>
                                <a class=" mt-2 btn btn-primary" href="{{route('faktur', $transaction->id)}}">Cetak Faktur</a>
                            @endif
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
                                @if ($transaction->bukti_pengiriman == null)
                                    <div class="small">Belum ada bukti pengiriman</div>
                                @else
                                    <img src="{{'/images/bukti_pengiriman/'.$transaction->bukti_pengiriman}}" alt="Bukti Pengiriman" class="img-fluid">
                                @endif
                                <form action="{{ route('order.upload', $transaction->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="bukti_pengiriman">Upload Bukti Pengiriman</label>
                                        <input type="file" class="form-control" name="bukti_pengiriman" id="bukti_pengiriman">
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
