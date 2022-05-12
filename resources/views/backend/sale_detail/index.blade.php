@extends('layouts.master')

@section('title')
Transaksi Pembelian
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
    .table-sale tbody tr:last-child {
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
      Transaksi Penjualan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Transaksi Penjualan</li>
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

            <form class="form-product">
              @csrf
            <div class="form-group row">
              <label for="product_code" class="col-md-2">Product Code</label>
              <div class="col-md-5">
                <div class="input-group">
                  <input type="hidden" name="id_sale" id="id_sale" value="{{ $id_sale }}">
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
            <table class="table table-stiped table-bordered table-sale">
              <thead>
                <th width="5%">No</th>
                <th style="width: 15px;">Code</th>
                <th>Produk</th>
                <th>Harga</th>
                <th style="width: 10px;">Jumlah</th>
                <th>Diskon</th>
                <th>Subtotal</th>
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
                  <form action="{{ route('transaksi.simpan') }}" class="form-sale" method="post">
                      @csrf
                      <input type="hidden" name="id_sale" value="{{ $id_sale }}">
                      <input type="hidden" name="total" id="total">
                      <input type="hidden" name="total_item" id="total_item">
                      <input type="hidden" name="bayar" id="bayar">
                      <input type="hidden" name="id_member" id="id_member" value="{{ $memberSelected->id_member }}">
                      <input type="hidden" name="poin" id="poin">

                    
                      <div class="form-group row">
                          <label for="totalrp" class="col-lg-2 control-label">Total</label>
                          <div class="col-lg-8">
                              <input type="text" id="totalrp" class="form-control" readonly>
                          </div>
                      </div>

                      <div class="form-group row">
                        <label for="member_code" class="col-lg-2 control-label">Member</label>
                        <div class="col-lg-8">
                          <div class="input-group">
                            <input type="text" id="member_code" name="member_code" class="form-control" value="{{ $memberSelected->member_code }}" required autofocus>
                            <span class="help-block with-errors"></span>
                            <span class="input-group-btn">
                              <button onclick="tampilMember()" class="btn btn-info btn-flat" type="button">
                                <i class="fa fa-arrow-right"></i>
                              </button>
                            </span>
                          </div>
                        </div>
                    </div>

                      <div class="form-group row">
                          <label for="discount" class="col-lg-2 control-label">Diskon</label>
                          <div class="col-lg-8">
                              <input type="number" name="discount" id="discount" class="form-control" value="{{ !empty($memberSelected->id_member) ? $setting : 0}}" readonly>
                          </div>
                      </div>
                     
                      <div class="form-group row">
                          <label for="bayar" class="col-lg-2 control-label">Bayar</label>
                          <div class="col-lg-8">
                              <input type="text" id="bayarrp" class="form-control" readonly>
                          </div>
                      </div>

                      <div class="form-group row">
                        <label for="diterima" class="col-lg-2 control-label">Diterima</label>
                        <div class="col-lg-8">
                            <input type="number" name="diterima" id="diterima" class="form-control" value="{{ $sale->accepted ?? 0 }}" > 
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="kembali" class="col-lg-2 control-label">Kembali</label>
                      <div class="col-lg-8">
                          <input type="text" name="kembalian" id="kembalian" class="form-control" value="0" readonly>
                      </div>
                  </div>
                      <div class="form-group row">
                        <label for="poinku" class="col-lg-2 control-label">Poin</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" value="0" name="poinku" id="poinku" readonly>
                        </div>
                    </div>
                  </form>
              </div>
            <!-- /.row -->
          </div>
          <!-- ./box-body -->

          <!-- /.box-footer -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i class="fa fa-floopy-o"></i>Simpan Transaksi</button>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>

  </section>
  <!-- /.content -->
</div>

@include('backend.sale_detail.product')
@include('backend.sale_detail.member')
@endsection

@push('scripts')

{{-- buat datatable --}}
<script>
  let table, table2, table3;

        $(function(){
            $('body').addClass('sidebar-collapse')
            table = $('.table-sale').DataTable({
            processing: false,
            autoWidth: false,
                ajax: {
                  url: '{{ route('transaksi.data', $id_sale) }}',
                },
                columns: [
                        {data: 'DT_RowIndex', searchable: false, sortable: false},
                        {data: 'product_code'},
                        {data: 'product_name'},
                        {data: 'price_sale'},
                        {data: 'amount'},
                        {data: 'discount'},
                        {data: 'subtotal'},
                        {data: 'aksi', searchable: false, sortable: false},
                ],
                dom: 'Brt',
                bSort: false,
                paginate: false
            })

            .on('draw.dt', function(){
                loadForm($('#discount').val());
                setTimeout(() => {
                  $('#diterima').trigger('input');
                }, 300);
            });

            table2 = $('.table-product').DataTable();
            table3 = $('.table-member').DataTable();

            $(document).on('input','.qty', function(){
              let id = $(this).data('id');
              let amount = parseInt($(this).val());

              if(amount > 10000){
                $(this).val(10000);
                alert('TIdak boleh lebih 10000');
                return;
              }

              $.post(`{{ url('/transaksi') }}/${id}`, {
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

            $('#diterima').on('input', function(){
              if ($(this).val() == "") {
                  $(this).val(0).select();
              }
              loadForm($('#discount').val(), $(this).val());
            }).focus(function(){
              $(this).select();
            })

            $('.btn-simpan').on('click', function(){
              $('.form-sale').submit();
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
          $.post('{{ route('transaksi.store') }}', $('.form-product').serialize())
            .done((response)=>{
              $('#product_code').focus();
              table.ajax.reload(() => loadForm($('#discount').val()));
            })
            .errors((response)=>{
              alert('Tidak dapat manyimpan data');
              return;
            })
        } 

        function hideMember(){
            $('#modal-member').modal('hide');
            
        }

        function tampilMember(){
            $('#modal-member').modal('show');
            
        }

        function pilihMember(id,code){
          $('#id_member').val(id);
          $('#member_code').val(code);
          $('#discount').val('{{ $setting }}');
          loadForm($('#discount').val());
          $('#diterima').val(0).focus().select();
          hideMember();
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

        function loadForm(discount = 0, diterima = 0){
          $('#total').val($('.total').text());
          $('#total_item').val($('.total_item').text());

          $.get(`{{ url('/transaksi/loadform') }}/${discount}/${$('.total').text()}/${diterima}`)
          .done(response => {
            $('#totalrp').val('Rp. '+ response.totalrp);
            $('#bayarrp').val('Rp. '+ response.bayarrp);
            $('#bayar').val(response.bayar);
            $('.tampil-bayar').text('Bayar : Rp. '+ response.bayarrp);
            $('.tampil-terbilang').text(response.terbilang);
            $('#poinku').val(response.poinku);
            
            $('#kembalian').val('Rp.'+ response.kembalirp);

            if($('#diterima').val() != 0){
              $('.tampil-bayar').text('Kembali : Rp. '+ response.kembalirp);
              $('.tampil-terbilang').text(response.kembalibilang);
            }
          })
          .fail(errors => {
            alert('tidak dapat menampilkan data');
            return;
          });
        }

</script>
@endpush
