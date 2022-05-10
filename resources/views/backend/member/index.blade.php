@extends('layouts.master')

@section('title')
    Member List
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
        Member List
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Member List</li>
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
                <button class="btn btn-success xs" onclick="addForm('{{ route('member.store') }}')"> <i class="fa fa-plus-circle"></i>   Add</button>
                <button class="btn btn-info xs" onclick="cetakBarcode('{{ route('member.barcode') }}')"> <i class="fa fa-id-card"></i>   Cetak Kartu</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form action="" method="post" class="form-member">
                @csrf
                <table class="table table-stiped table-bordered">
                    <thead>
                      <th width="5%">
                        <input type="checkbox" name="select_all" id="select_id">
                      </th>
                        <th width="5%">No</th>
                        <th>Tanggal Pembuatan</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Tanggal Lahir</th>
                        <th>Sisa Poin</th>
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

  @include('backend.member.form')
@endsection

@push('scripts')

<!-- datepicker -->
<script src="{{ asset('AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

{{-- buat datatable --}}
    <script>
        let table;

        $(function(){
            table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
                ajax: {
                    url: '{{ route('member.data') }}'
                },
                columns: [
                        {data: 'select_all', searchable: false, sortable: false},
                        {data: 'DT_RowIndex', searchable: false, sortable: false},
                        {data: 'created_at'},
                        {data: 'member_code'},
                        {data: 'name'},
                        {data: 'address'},
                        {data: 'phone'},
                        {data: 'tanggal_lahir'},
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
            $('#modal-form .modal-title').text('Add Member');

            
            $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
            });

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=member_code]').focus();
        }

        function editForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Member');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=name]').focus();

            $.get(url)
              .done((response) => {
                $('#modal-form [name=name]').val(response.name);
                $('#modal-form [name=address]').val(response.address);
                $('#modal-form [name=tanggal_lahir]').val(response.tanggal_lahir);
                $('#modal-form [name=phone]').val(response.phone);

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

        function cetakBarcode(url){
          if($('input:checked').length < 1){
            alert('Pilih data yang ingin dicetak');
            return;
          }
          else{
            $('.form-member').attr('action',url).attr('target','_blank').submit();
          }
        }

        
    </script>
@endpush
