@extends('layouts.master')

@section('title')
Pembelian List
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pembelian List
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pembelian List</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <div class="btn-group">
              <button class="btn btn-success xs" onclick="addForm()"> <i
                  class="fa fa-plus-circle"></i> Transaksi Baru</button>

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-stiped table-bordered">
              <thead>

                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th>Item</th>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Bayar</th>
                <th width="10%"><i class="fa fa-cog"></i></th>
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

@include('backend.purchase.supplier')
@endsection

@push('scripts')

{{-- buat datatable --}}
<script>
  let table;

        $(function(){
            table = $('.table').DataTable({
            // processing: true,
            // autoWidth: false,
            //     ajax: {
            //         
            //     },
            //     columns: [
            //             {data: 'DT_RowIndex', searchable: false, sortable: false},
            //             {data: 'created_at'},
            //             {data: 'deskripsi'},
            //             {data: 'nominal'},
            //             {data: 'aksi', searchable: false, sortable: false},
            //     ]
            });
        });

        function addForm(){
            $('#modal-supplier').modal('show');
            
        }

        function editForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Pengeluaran');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=deskripsi]').focus();

            $.get(url)
              .done((response) => {
                $('#modal-form [name=deskripsi]').val(response.deskripsi);
                $('#modal-form [name=nominal]').val(response.nominal);

              })

              .fail((errors) => {
                alert('Data tidak ditemukan');
                return;
              })
        }

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