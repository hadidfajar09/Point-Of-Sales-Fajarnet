@extends('layouts.master')

@section('title')
Penjualan List
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Penjualan List
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Penjualan List</li>
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
            <table class="table table-stiped table-bordered table-penjualan">
              <thead>

                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Member</th>
                <th>Item</th>
                <th>Harga</th>
                <th>Diskon</th>
                <th>Bayar</th>
                <th>Kasir</th>
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

@include('backend.sale.detail')
@endsection

@push('scripts')

{{-- buat datatable --}}
<script>
  let table, table3;

        $(function(){
            table = $('.table-penjualan').DataTable({
              processing: true,
              autoWidth: false,
                ajax: {
                    url: '{{ route('sale.data') }}'
                },
                columns: [
                        {data: 'DT_RowIndex', searchable: false, sortable: false},
                        {data: 'created_at'},
                        {data: 'member'},
                        {data: 'total_item'},
                        {data: 'total_price'},
                        {data: 'discount'},
                        {data: 'pay'},
                        {data: 'kasir'},
                        {data: 'aksi', searchable: false, sortable: false},
                ]
            });

            table3 = $('.table-detail').DataTable({
              processing: true,
              bsort: false,
              dom: 'Brt',
              columns: [
                        {data: 'DT_RowIndex', searchable: false, sortable: false},
                        {data: 'product_code'},
                        {data: 'product_name'},
                        {data: 'price_sale'},
                        {data: 'amount'},
                        {data: 'subtotal'},
                ]
            });
        });

        function detailForm(url){
          $('#modal-detail').modal('show');

          table3.ajax.url(url);
          table3.ajax.reload();
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