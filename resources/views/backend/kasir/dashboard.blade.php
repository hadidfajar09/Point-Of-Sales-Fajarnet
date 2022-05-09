@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
    
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-body text-center">
              <h1>Selamat datang <br> <strong>{{ Auth::user()->name }}</strong></h1>
              <h2>Anda Login Sebagai Kasir </h2>
              <br><br>
              <a href="{{ route('transaksi.baru') }}" class="btn btn-success btn-lg">Transaksi Baru</a><br><br>
              <a href="{{ route('changer.index') }}" class="btn btn-info btn-lg">Penukaran Baru</a>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
@endsection