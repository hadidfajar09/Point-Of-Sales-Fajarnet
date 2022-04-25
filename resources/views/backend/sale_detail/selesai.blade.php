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
          <div class="box-body table-responsive">
            <div class="alert alert-success alert-dismissible">
              <i class="fa fa-check icon"></i>
              Data Transaksi telah selesai.
          </div>
            <!-- /.row -->
            <button class="btn btn-primary" onclick="notaKecil()">Cetak Nota</button>
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



@endpush