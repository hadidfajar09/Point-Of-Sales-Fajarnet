<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Member</title>

    <style>
        .box {
            position: relative;
        }
        .card {
            width: 85.60mm;
        }
        .logo {
            position: absolute;
            top: 3pt;
            right: 0pt;
            font-size: 16pt;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: #fff !important;
        }
        .logo p {
            text-align: right;
            margin-right: 16pt;
        }
        .logo img {
            position: absolute;
            margin-top: 20px;
            width: 40px;
            height: 40px;
            right: 16pt;
        }
        .name {
            position: absolute;
            top: 100pt;
            right: 16pt;
            font-size: 9pt;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: rgb(255, 255, 255) !important;
        }
        .phone {
            position: absolute;
            top: 120pt;
            right: 16pt;
            font-size: 8pt;
            font-family: Arial, Helvetica, sans-serif;
            color: rgb(255, 255, 255) !important;
        }
        .barcode {
            position: absolute;
            top: 105pt;
            left: .860rem;
            border: 1px solid #fff;
            padding: .5px;
            background: #fff;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
    
</head>
<body>
    <section style="border: 1px solid #fff">
        <table width="100%">
            @foreach ($datamember as $key => $data)
                <tr>
                    @foreach ($data as $row)
                        <td class="text-center" with="50%">
                            <div class="box">
                                <img src="{{ asset($setting->path_member) }}" alt="card" width="100%">
                                <div class="logo">
                                    <img src="{{ asset($setting->path_logo) }}" alt="card">
                                </div>
                                <div class="name">{{ $row->name }}</div>
                                <div class="phone">{{ $row->phone }}</div>
                                <div class="barcode text-left">
                                    <img src="data:image/png;base64, {{ DNS2D::getBarcodePNG("$row->member_code",'QRCODE') }}" alt="qrcode" bg-color="#fff" height="45" width="45">
                                </div>
                            </div>
                        </td>
                      @if (count($datamember) == 1){
                          <td class="text-center" width="50%"></td>
                      }
                          
                      @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </section>
</body>
</html>
