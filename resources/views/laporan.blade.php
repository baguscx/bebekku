<title>Laporan Penjualan Bebek</title>
<div style="text-align: center;">
    <h1>Laporan Penjualan Bebek</h1>
    <table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $key => $transaction)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->isoFormat('D MMMM YYYY', 'Do MMMM YYYY') }}<br /></td>
            <td>{{ $transaction->product->name }}</td>
            <td>{{ $transaction->quantity }}</td>
            <td>Rp. {{ number_format($transaction->product->price, 0, ',', '.') }}</td>
            <td>Rp. {{ number_format($transaction->total, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align: right;"><b>Total Penjualan | </b></td>
            <td><b>Rp. {{ number_format($transactions->sum('total'), 0, ',', '.') }}</b></td>
        </tr>
    </tbody>
</table>

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #f2f2f2;
    }
</style>
