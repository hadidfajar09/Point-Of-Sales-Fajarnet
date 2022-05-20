@extends('layouts.master')

@section('title')
Laporan Pendapatan 
@endsection

@push('css')
      <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Laporan Pendapatan {{ formatTanggal($tanggalAwal,false) }} s/d {{ formatTanggal($tanggalAkhir,false) }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laporan Pendapatan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
        <div class="box-header with-border">
            <button class="btn btn-warning" onclick="updatePeriode('{{ route('laporan.index') }}')"><i class="fa fa-plus-circle"></i> Ubah Periode</button>

            <a href="{{ route('laporan.export',[$tanggalAwal,$tanggalAkhir]) }}" target="_blank" class="btn btn-success" onclick="updatePeriode('{{ route('laporan.index') }}')"><i class="fa fa-file-excel-o"></i> Export PDF</a>
        </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-stiped table-bordered table-report">
              <thead>

                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Penjualan</th>
                <th>Pembelian</th>
                <th>Pengeluaran</th>
                <th>Pendapatan</th>
              </thead>

            </table>
            <!-- /.row -->
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

@include('backend.report.periode')
@endsection

@push('scripts')
<!-- datepicker -->
<script src="{{ asset('AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

{{-- buat datatable --}}
<script>
  let table, table3;

        $(function(){
            table = $('.table-report').DataTable({
              responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
                ajax: {
                    url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}'
                },
                columns: [
                        {data: 'DT_RowIndex', searchable: false, sortable: false},
                        {data: 'tanggal'},
                        {data: 'penjualan'},
                        {data: 'pembelian'},
                        {data: 'pengeluaran'},
                        {data: 'pendapatan'},
                ],

                dom: 'Brt',
            bSort: false,
            bPaginate: false,
            });
            
        });

        
        function updatePeriode(){
            $('#modal-periode').modal('show');
            
        }

            $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

</script>
@endpush