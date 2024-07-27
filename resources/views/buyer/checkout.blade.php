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

    <div class="container my-4">
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

                @if ($transaction->status == 'pending')
                    <button id="pay-button" class="btn btn-success mt-4">Pay Now</button>
                @endif

            </div>
        </div>
    </div>

    @if ($transaction->status == 'success')
        <div class="container my-4">
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
                        @endif
                    </ul>
                        @if ($transaction->bukti_pengiriman == null)
                            <div class="small">Belum ada bukti pengiriman</div>
                        @else
                            <img src="{{'/images/bukti_pengiriman/'.$transaction->bukti_pengiriman}}" width="150px" alt="Bukti Pengiriman" class="img-fluid mt-2">
                        @endif
                </div>
            </div>
        </div>
    @endif


    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('services.midtrans.clientKey')}}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $transaction->snap_token }}', {
          // Optional
          onSuccess: function(result){
            // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            window.location.href = '{{ route('checkout-success', $transaction->id) }}'
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
</x-app-layout>
