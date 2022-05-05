@extends('layouts.master')

@section('title')
    Product List
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product List</li>
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
                <button class="btn btn-success xs" onclick="addForm('{{ route('product.store') }}')"> <i class="fa fa-plus-circle"></i>   Add</button>
                <button class="btn btn-danger xs" onclick="deleteSelected('{{ route('product.deleteselected') }}')"> <i class="fa fa-trash"></i>   Hapus</button>
                <button class="btn btn-info xs" onclick="cetakBarcode('{{ route('product.barcode') }}')"> <i class="fa fa-barcode"></i>   Cetak Barcode</button>
              </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <form action="" method="post" class="form-product">
                 @csrf
                <table class="table table-stiped table-bordered">
                  <thead>
                      <th width="5%">
                        <input type="checkbox" name="select_all" id="select_id">
                      </th>
                      <th width="5%">No</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Produk</th>
                      <th>Brand</th>
                      <th>Harga Beli</th>
                      <th>Harga Jual</th>
                      <th>Discount</th>
                      <th>Stock</th>
                      <th>Poin</th>
                      <th width="10%"><i class="fa fa-cog"></i></th>
                  </thead>
                  
              </table>
               </form>
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

  @include('backend.product.form')
@endsection

@push('scripts')

{{-- buat datatable --}}
    <script>
        let table;

        $(function(){
            table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
                ajax: {
                    url: '{{ route('product.data') }}'
                },
                columns: [
                        {data: 'select_all', searchable: false, sortable: false},
                        {data: 'DT_RowIndex', searchable: false, sortable: false},
                        {data: 'product_code'},
                        {data: 'category_name'},
                        {data: 'product_name'},
                        {data: 'brand'},
                        {data: 'purchase_price'},
                        {data: 'sale_price'},
                        {data: 'discount'},
                        {data: 'stock'},
                        {data: 'poin'},
                        {data: 'aksi', searchable: false, sortable: false},
                ]
            });

            $('#modal-form').validator().on('submit', function(e){
                if (! e.preventDefault()) {
                    $.ajax({
                        url: $('#modal-form form').attr('action'),
                        type: 'post',
                        data: $('#modal-form form').serialize()
                    })
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })

                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
                }
            });

            $('[name=select_all]').on('click', function(){
              $(':checkbox').prop('checked', this.checked);
            });

        });

        function addForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Add Product');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=product_name]').focus();
        }

        function editForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Product');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=product_name]').focus();

            $.get(url)
              .done((response) => {
                $('#modal-form [name=product_name]').val(response.product_name);
                $('#modal-form [name=id_category]').val(response.id_category);
                $('#modal-form [name=brand]').val(response.brand);
                $('#modal-form [name=purchase_price]').val(response.purchase_price);
                $('#modal-form [name=sale_price]').val(response.sale_price);
                $('#modal-form [name=discount]').val(response.discount);
                $('#modal-form [name=stock]').val(response.stock);
                $('#modal-form [name=poin]').val(response.poin);

              })

              .fail((errors) => {
                alert('Data tidak ditemukan');
                return;
              });
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

        function deleteSelected(url){
          if ($('input:checked').length > 1) {
            if(confirm('Yakin ingin menghapus data terpilih?')){
              $.post(url, $('.form-product').serialize())
              .done((response) => {
                  table.ajax.reload();
              })
  
              .fail((response) => {
                alert('tidak dapat menghapus data');
                return;
              });

            }
          } else {;
            alert('Pilih data yang ingin dihapus');
            return;
          }
          
        }

        function cetakBarcode(url){
          if($('input:checked').length < 1){
            alert('Pilih data yang ingin dicetak');
            return;
          }
          else if($('input:checked').length < 3){
            alert('Pilih minimal 3 data untuk dicetak');
            return;
          }else{
            $('.form-product').attr('action',url).attr('target','_blank').submit();
          }
        }
    </script>
@endpush