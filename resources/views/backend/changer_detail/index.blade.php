@extends('layouts.master')

@section('title')
Transaksi Penukaran Poin
@endsection

@push('css')
    <style>
      .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;
    }
    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }
    .table-changer tbody tr:last-child {
        display: none;
    }
    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
    </style>
@endpush

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Transaksi Penukaran Poin
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Transaksi Penukaran Poin</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <table class="">
              <tr>
                <td>Member &nbsp;&nbsp;&nbsp;</td>
                <td><strong> : {{ $member->name }}</strong> </td>
              </tr>
              <tr>
                <td>Phone &nbsp;&nbsp;&nbsp;</td>
                <td><strong> : {{ $member->phone }}</strong></td>
              </tr>
              <tr>
                <td>Alamat &nbsp;&nbsp;&nbsp;</td>
                <td><strong> : {{ $member->address }}</strong></td>
              </tr>
              <tr>
                <td>Sisa Poin &nbsp;&nbsp;&nbsp;</td>
                <td><strong> : {{ $member->poin }}</strong></td>
              </tr>
            </table>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">

            <form class="form-product">
              @csrf
            <div class="form-group row">
              <label for="product_code" class="col-md-2">Product Code</label>
              <div class="col-md-5">
                <div class="input-group">
                  <input type="hidden" name="id_changer" id="id_changer" value="{{ $id_changer }}">
                  <input type="hidden" name="id_product" id="id_product">
                  <input type="text" class="form-control" name="product_code" id="product_code">
                  <span class="input-group-btn">
                    <button onclick="addProduct()" class="btn btn-info btn-flat" type="button">
                      <i class="fa fa-arrow-right"></i>
                    </button>
                  </span>
                </div>

              </div>
            </div>
          </form>
            <br>
            <table class="table table-stiped table-bordered table-changer">
              <thead>

                <th width="5%">No</th>
                <th style="width: 15px;">Code</th>
                <th>Produk</th>
                <th>Harga</th>
                <th style="width: 10px;">Jumlah</th>
                <th>Subtotal</th>
                <th>Biaya Poin</th>
                <th style="width: 15px;"><i class="fa fa-cog"></i></th>
              </thead>

            </table>

            {{-- banner --}}
            <div class="row">
              <div class="col-md-8">
                  <div class="tampil-bayar bg-primary"></div>
                  <div class="tampil-terbilang"></div>
              </div>
              <div class="col-lg-4">
                  <form action="{{ route('changer.store') }}" class="form-changer" method="post">
                      @csrf
                      <input type="hidden" name="id_changer" value="{{ $id_changer }}">
                      <input type="hidden" name="total" id="total">
                      <input type="hidden" name="total_item" id="total_item">
                      <input type="hidden" name="bayar" id="bayar">
                      <input type="hidden" name="jumlah_poin" id="jumlah_poin">

                      <div class="form-group row">
                          <label for="totalrp" class="col-lg-3 control-label">Total</label>
                          <div class="col-lg-8">
                              <input type="text" id="totalrp" class="form-control" readonly>
                          </div>
                      </div>
                    
                      <div class="form-group row">
                          <label for="bayar" class="col-lg-3 control-label">Bayar</label>
                          <div class="col-lg-8">
                              <input type="text" id="bayarrp" class="form-control">
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="jumlah_poin" class="col-lg-3 control-label">Poin Bayar</label>
                        <div class="col-lg-8">
                            <input type="text" name="total_jumlah_poin" id="total_jumlah_poin" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="sisa_poin" class="col-lg-3 control-label">Sisa Poin</label>
                      <div class="col-lg-8">
                          <input type="text" id="sisa_poin" class="form-control">
                      </div>
                  </div>
                  </form>
              </div>
            <!-- /.row -->
          </div>
          <!-- ./box-body -->

          <!-- /.box-footer -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floopy-o"></i>Simpan Penukaran</button>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>

  </section>
  <!-- /.content -->
</div>

@include('backend.changer_detail.product')
@endsection

@push('scripts')

{{-- buat datatable --}}
<script>
  let table, table2;

        $(function(){
          $('body').addClass('sidebar-collapse');
            table = $('.table-changer').DataTable({
            processing: false,
            autoWidth: false,
                ajax: {
                  url: '{{ route('changer_detail.data', $id_changer) }}'
                },
                columns: [
                        {data: 'DT_RowIndex', searchable: false, sortable: false},
                        {data: 'product_code'},
                        {data: 'product'},
                        {data: 'price_purchase'},
                        {data: 'amount'},
                        {data: 'subtotal'},
                        {data: 'total_poin'},
                        {data: 'aksi', searchable: false, sortable: false},
                ],
                dom: 'Brt',
                bSort: false,
            })

            .on('draw.dt', function(){
                loadForm($('#discount').val());
            });

            table2 = $('.table-product').DataTable();

            $(document).on('input','.qty', function(){
              let id = $(this).data('id');
              let amount = parseInt($(this).val());

              if(amount > 10000){
                $(this).val(10000);
                alert('TIdak boleh lebih 10000');
                return;
              }

              $.post(`{{ url('/changer-detail') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'amount': amount
                })
                .done(response => {
                  $(this).on('mouseout', function () {
                        table.ajax.reload(() => loadForm($('#discount').val()));
                    });

                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
            });

            $(document).on('input','#discount', function(){
              if($(this).val() == ""){
                $(this).val(0).select();
              }
              loadForm($(this).val());
            });

            $('.btn-simpan').on('click', function(){
              $('.form-changer').submit();
            });

        });

        function addProduct(){
            $('#modal-product').modal('show');
            
        }

        function hideProduct(){
            $('#modal-product').modal('hide');
            
        }

        function pilihProduct(id,code){
          $('#id_product').val(id);
          $('#product_code').val(code);
          hideProduct();
          tambahProduct();
        }

        function tambahProduct(){
          $.post('{{ route('changer-detail.store') }}', $('.form-product').serialize())
            .done((response)=>{
              $('#product_code').focus();
              table.ajax.reload(() => loadForm($('#discount').val()));
            })
            .errors((response)=>{
              alert('Tidak dapat manyimpan data');
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
                  table.ajax.reload(() => loadForm($('#discount').val()));
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
              });
          }
        }

        function loadForm(discount = 0){
          $('#total').val($('.total').text());
          $('#total_item').val($('.total_item').text());
          $('#total_jumlah_poin').val($('.jumlah_poin').text());

          $.get(`{{ url('/changer-detail/loadform') }}/${discount}/${$('.total').text()}/${$('.jumlah_poin').text()}`)
          .done(response => {
            $('#totalrp').val('Rp. '+ response.totalrp);
            $('#bayarrp').val('Rp. '+ response.bayarrp);
            $('#bayar').val(response.bayar);
            $('#total_jumlah_poin').val(response.jumlah_poin);
            $('#sisa_poin').val(response.sisa_poin);
            $('.tampil-bayar').text('Bayar : Rp. '+ response.bayarrp);
            $('.tampil-terbilang').text(response.terbilang);
            

            
          })
          .fail(errors => {
            alert('tidak dapat menampilkan data');
            return;
          });
        }

</script>
@endpush
