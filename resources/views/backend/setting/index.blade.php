@extends('layouts.master')

@section('title')
Pengaturan
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
      Pengaturan
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengaturan</li>
    </ol>
  </section>

  <!-- Main content -->
 <section class="content">
  <div class="row">
      <div class="col-lg-12">
          <div class="box">

                <form action="{{ route('setting.update') }}" class="form-setting" data-toggle="validator" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="alert alert-info alert dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <i class="icon fa fa-check"> Perubahan Berhasil disimpan</i>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Nama Perusahaan</label>
                            <div class="col-lg-6">

                                <input type="text" class="form-control" name="company_name" id="company_name" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Alamat</label>
                            <div class="col-lg-6">

                                <textarea class="form-control" name="address" id="address" rows="3" required> </textarea>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Phone</label>
                            <div class="col-lg-6">

                                <input type="number" class="form-control" name="phone" id="phone" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Logo Perusahaan</label>
                            <div class="col-lg-6">

                                <input type="file" class="form-control" name="path_logo" id="path_logo" onchange="preview('.tampil-logo',this.files[0])">
                                <span class="help-block with-errors"></span><br>
                                <div class="tampil-logo"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <span class="text-danger"> Wajib Ukuran 1280 * 720</span>
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Kartu Member</label>
                            <div class="col-lg-6">

                                <input type="file" class="form-control" name="path_member" id="path_member" onchange="preview('.tampil-member',this.files[0], 300)">
                                <span class="help-block with-errors"></span><br>
                                <div class="tampil-member"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Diskon</label>
                            <div class="col-lg-2">

                                <input type="number" class="form-control" name="discount" id="discount" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Tipe Nota</label>
                            <div class="col-lg-2">
                                <select class="form-control" name="nota_type" id="nota_type">
                                    <option value="2">Nota Besar</option>
                                    <option value="1">Nota Kecil</option>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <button class="btn btn-primary" >Update</button>
                    </div>
                
                </form>
          </div>
      </div>
  </div>
</section>
  <!-- /.content -->
</div>


@endsection

@push('scripts')

<script>
    $(function(){
        showData();
        $('.form-setting').validator().on('submit',function(e){
            if(! e.preventDefault()){
                $.ajax({
                    url: $('.form-setting').attr('action'),
                    type: $('.form-setting').attr('method'),
                    data: new FormData($('.form-setting')[0]),
                    async: false,
                    processData: false,
                    contentType: false,
                })
                .done(response => {
                    showData();
                    $('.alert').fadeIn();

                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errorrs => {
                    alert('tidak dapat menyimpan data');
                    return;
                });
            }
        });
    });

    function showData(){
        $.get('{{ route('setting.show') }}')
        .done(response => {
            $('#company_name').val(response.company_name);
            $('#phone').val(response.phone);
            $('#address').val(response.address);
            $('#discount').val(response.discount);
            $('#nota_type').val(response.nota_type);
            $('title').text(response.company_name + ' | Pengaturan');

            $('.tampil-logo').html(`<img src="{{ url('/') }}/${response.path_logo}" width="200px">`);
            $('.tampil-member').html(`<img src="{{ url('/') }}/${response.path_member}" width="300px">`);
            $('[rel=icon]').attr('href',`{{ url('/') }}/${response.path_logo}`);
        })
        .fail(errors => {
            alert('Tidak dapat menampilkan data');
            return;
        })
    }
</script>
@endpush
