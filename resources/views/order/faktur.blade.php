
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Faktur #{{$transaction->id}}</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									{{-- <img
										src="https://sparksuite.github.io/simple-html-invoice-template/images/logo.png"
										style="width: 100%; max-width: 300px"
									/> --}}
                                    <h3>BEBEKKU</h3>
								</td>
                                <td style="text-align: left;"></td>
								<td>
                                    ID Pesanan #: {{$transaction->id}}<br />
                                    Dibuat: {{ \Carbon\Carbon::parse($transaction->created_at)->isoFormat('D MMMM YYYY', 'Do MMMM YYYY') }}<br />		</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									{{$transaction->user->name}}<br />
									{{$transaction->user->email}}<br />
									{{$transaction->user->phone}}<br />
								</td>
								<td>
									{{$transaction->user->address}}<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Metode Pembayaran</td>
					<td>Kode #</td>
				</tr>

				<tr class="details">
					<td>Midtrans</td>
                    <td>{{$transaction->id}}</td>
                </tr>
                <tr class="heading">
                    <td>Barang</td>
                    <td>Harga</td>
                </tr>

                <tr class="item">
                    <td>{{$transaction->product->name}} x {{$transaction->quantity}} items</td>
                    <td>Rp. {{ number_format($transaction->product->price, 0, ',', '.') }}</td>
                </tr>
				<tr class="total">
					<td></td>
					<td>
                        <b>Total: Rp.{{ number_format($transaction->total, 0, ',', '.') }}</b>
                    </td>
				</tr>
			</table>
		</div>
	</body>
</html>
