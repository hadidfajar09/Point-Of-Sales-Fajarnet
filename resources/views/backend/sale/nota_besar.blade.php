<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota PDF</title>

    <style>
        table td {
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 14px;
        }
        table.data td,
        table.data th {
            border: 1px solid #ccc;
            padding: 5px;
        }
        table.data {
            border-collapse: collapse;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body">
    <table width="100%">
        <tr>
            <td rowspan="4" width="60%">
                <img src="{{ asset($setting->path_logo) }}" alt="{{ $setting->path_logo }}" width="100">
                <br>
                {{ $setting->address }} <br>
                No Invoice : {{ tambahNolDepan($sale->id,6)  }}
            <br>
            </td>
            <td>Tanggal</td>
            <td>: {{ formatTanggal(date('Y-m-d')) }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: {{ $sale->member['name'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Code</td>
            <td>: {{ $sale->member['member_code'] ?? '-' }}</td>
        </tr>
    </table>

    <table class="data" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $item)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $item->product->product_code }}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td class="text-right">Rp {{ formatUang($item->price_sale) }}</td>
                    <td class="text-right">{{ formatUang($item->amount) }}</td>
                    <td class="text-right">{{ $item->discount }}</td>
                    <td class="text-right">Rp {{ formatUang($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><b>Total Harga</b></td>
                <td class="text-right"><b>Rp {{ formatUang($sale->total_price) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Diskon</b></td>
                <td class="text-right"><b>{{ formatUang($sale->discount) }}%</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Total Bayar</b></td>
                <td class="text-right"><b>Rp {{ formatUang($sale->pay) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Diterima</b></td>
                <td class="text-right"><b>Rp {{ formatUang($sale->accepted) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Kembali</b></td>
                <td class="text-right"><b>Rp {{ formatUang($sale->accepted - $sale->pay) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right"><b>Poin</b></td>
                <td class="text-right"><b>{{ round($sale->total_price / 25000) }} Poin</b></td>
            </tr>
        </tfoot>
    </table>

    <table width="100%">
        <tr>
            <td><b>Terimakasih telah berbelanja dan sampai jumpa</b></td>
            <td class="text-center"> <br><br>
                Kasir
                <br>
                <br>
                {{ auth()->user()->name }}
            </td>
        </tr>
    </table>
</body>
</html>