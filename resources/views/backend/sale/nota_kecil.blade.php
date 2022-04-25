<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Transaksi</title>
       <style>
        * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        @media print {
            @page {
                margin: 0;
                size: 75mm }}
    </style>
</head>
<body>
    <div class="text-center">
        <h2 style="margin-bottom: 5px;">{{ strtoupper($setting->company_name) }}</h2>
        <p>{{ $setting->address }}</p>
    </div><br>
    <div>
        <p style="float: left;">{{ formatTanggal(date(now())) }}</p>
        <p style="float: right;">{{ strtoupper(auth()->user()->name) }}</p>
    </div>
    <div class="clear-both" style="clear: both"></div>
    <p>No Faktur : {{ tambahNolDepan($sale->id,6)  }}</p>
     <p class="text-center">===================================</p>
    <table width=100% style="border: 0">
        @foreach ($detail as $row)
            <tr>
                <td colspan="3">{{ $row->product['product_name'] }}</td>
            </tr>
            <tr>
                <td>{{ $row->amount }} x {{ formatUang($row->price_sale) }}</td>
                <td></td>
                <td class="text-right">Rp. {{ formatUang($row->amount * $row->price_sale) }}</td>
            </tr>
        @endforeach
    </table>
     <p class="text-center">===================================</p>

    <table width="100%" style="border: 0">
        <tr>
            <td>Total Harga : </td>
            <td class="text-right">Rp. {{ formatUang($sale->total_price) }}</td>
        </tr>
        <tr>
            <td>Total Item : </td>
            <td class="text-right">{{ formatUang($sale->total_item) }} item</td>
        </tr>
        <tr>
            <td>Discount : </td>
            <td class="text-right">{{ formatUang($sale->discount) }}%</td>
        </tr>
        <tr>
            <td>Total Bayar : </td>
            <td class="text-right">Rp. {{ formatUang($sale->pay) }}</td>
        </tr>
        <tr>
            <td>Diterima : </td>
            <td class="text-right">Rp. {{ formatUang($sale->accepted) }}</td>
        </tr>
        <tr>
            <td>Kembali : </td>
            <td class="text-right">Rp. {{ formatUang($sale->accepted - $sale->pay) }}</td>
        </tr>
    </table>

     <p class="text-center">===================================</p>

    <p class="text-center">== Terima Kasih == <br> Telah Berbelanja di <strong>{{ config('app.name') }}</strong> </p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );
        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);
    </script>
</body>
</html>