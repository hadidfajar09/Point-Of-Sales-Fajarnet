@extends('layouts.master')

@section('title')
Laporan Pendapatan 
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Laporan Pendapatan {{ formatTanggal($tanggalAwal) }} s/d {{ formatTanggal($tanggalAkhir) }}
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
            <button class="btn btn-success" onclick="updatePeriode('{{ route('laporan.index') }}')"><i class="fa fa-plus-circle"></i> Ubah Periode</button>

            <a href="{{ route('laporan.export',[$tanggalAwal,$tanggalAkhir]) }}" target="_blank" class="btn btn-info" onclick="updatePeriode('{{ route('laporan.index') }}')"><i class="fa fa-plus-circle"></i> Export PDF</a>
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

{{-- buat datatable --}}
<script>
  let table, table3;

        $(function(){
            table = $('.table-report').DataTable({
              processing: true,
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
                ]
            });
            
        });

        
        function updatePeriode(){
            $('#modal-periode').modal('show');
            
        }

        $('#modal-periode').validator().on('submit', function(e){
                if (! e.preventDefault()) {
                    $.ajax({
                        url: $('#modal-periode form').attr('action'),
                        type: 'post',
                        data: $('#modal-periode form').serialize()
                    })
                    .done((response) => {
                        $('#modal-periode').modal('hide');
                        table.ajax.reload();
                    })

                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
                }
            });

        $('.datepicker').datapicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });


        function deleteData(url) {
          if(confirm('Yakin Ingin Hapus Data?')){
            
          $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete'
          })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
              });
          }
        }

</script>
@endpush