<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>
    <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
</head>
<body>
    @php
        $setting = DB::table('settings')->first();
    @endphp
    <h3 class="text-center">Laporan Pendapatan Member System</h3>
    <h2 class="text-center" style="color: red;">{{ $setting->company_name }}</h2>
    <h4 class="text-center">
        Tanggal {{ formatTanggal($awal, false) }}
        s/d Tanggal {{ formatTanggal($akhir, false) }}

    </h4>

    <table class="table table-striped">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Tanggal</th>
                    <th>Penjualan</th>
                    <th>Pembelian</th>
                    <th>Pengeluaran</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        @foreach ($row as $col)
                            <td>{{ $col }}</td>
                        @endforeach    
                    </tr>  
                @endforeach
            </tbody>
    </table>
</body>
</html>