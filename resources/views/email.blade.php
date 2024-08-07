<!DOCTYPE html>
<html>
<head>
    <title>Pemberitahuan Pembelian Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Pemberitahuan Pembelian Produk</h3>
        <p>Terimakasih, Anda telah berhasil membeli produk <b>{{ $mailData['product']->name }}.</b></p>
        <p>Berikut adalah detail transaksi:</p>
        <table>
            <tr>
                <th>ID Transaksi</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>{{ $mailData['transaction']->id }}</td>
                <td>{{ $mailData['transaction']->quantity }}</td>
                <td>{{ $mailData['transaction']->total }}</td>
            </tr>
        </table>
        <p>Terimakasih atas pembelian Anda.</p>
    </div>
</body>
</html>
