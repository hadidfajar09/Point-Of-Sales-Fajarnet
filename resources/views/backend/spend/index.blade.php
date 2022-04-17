@extends('layouts.master')

@section('title')
Pengeluaran List
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengeluaran List
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengeluaran List</li>
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
              <button class="btn btn-success xs" onclick="addForm('{{ route('spend.store') }}')"> <i
                  class="fa fa-plus-circle"></i> Add</button>

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-stiped table-bordered">
              <thead>

                <th width="5%">No</th>
                <th>Tanggal Pengeluaran</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
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

@include('backend.spend.form')
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
                    url: '{{ route('spend.data') }}'
                },
                columns: [
                        {data: 'DT_RowIndex', searchable: false, sortable: false},
                        {data: 'created_at'},
                        {data: 'deskripsi'},
                        {data: 'nominal'},
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

        });

        function addForm(url){
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Add Pengeluaran');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action',url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=deskripsi]').focus();
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