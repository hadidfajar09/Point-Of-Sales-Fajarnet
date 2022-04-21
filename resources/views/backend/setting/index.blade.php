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
                <form action="{{ route('setting.update') }}" data-toggle="validator" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
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

                                <input type="text" class="form-control" name="phone" id="phone" required>
                                <span class="help-block with-errors"></span>
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
                                    <option value="1">Nota Besar</option>
                                    <option value="2">Nota Kecil</option>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
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

@endpush
