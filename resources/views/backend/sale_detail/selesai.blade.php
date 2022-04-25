@extends('layouts.master')

@section('title')
Transaksi Selesai
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Transaksi Selesai
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Transaksi Selesai</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
        
          <!-- /.box-header -->
          <div class="box-body">
            <div class="alert alert-success alert-dismissible">
              <i class="fa fa-check icon"></i>
              Data Transaksi telah selesai.
          </div>
            <!-- /.row -->
          </div>
          <div class="box-footer">
            @if ($setting->nota_type == 1)
            <button class="btn btn-primary" onclick="notaKecil('{{ route('transaksi.nota_kecil') }}','Nota PDF')">Cetak Nota</button>
            @else
            <button class="btn btn-primary" onclick="notaBesar('{{ route('transaksi.nota_besar','Nota PDF')">Cetak Nota</button>
            @endif
            <a href="{{ route('transaksi.baru') }}" class="btn btn-warning">Transaksi Baru</a>

          </div>

          <!-- ./box-body -->

          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>

  </section>
  <!-- /.content -->
</div>


@endsection

@push('scripts')

<script>
  function notaKecil(){
    popupCenter(url,title,720,675);
  }
  function notaBesar(){
    popupCenter(url,title,720,675);
  }

  function popupCenter(url, title, w, h){
    // Fixes dual-screen position                             Most browsers      Firefox
    const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
    const dualScreenTop = window.screenTop !==  undefined   ? window.screenTop  : window.screenY;

    const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    const systemZoom = width / window.screen.availWidth;
    const left = (width - w) / 2 / systemZoom + dualScreenLeft
    const top = (height - h) / 2 / systemZoom + dualScreenTop
    const newWindow = window.open(url, title, 
      `
      scrollbars=yes,
      width=${w / systemZoom}, 
      height=${h / systemZoom}, 
      top=${top}, 
      left=${left}
      `
    )

    if (window.focus) newWindow.focus();
}
</script>


@endpush