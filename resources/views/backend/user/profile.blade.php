@extends('layouts.master')

@section('title')
Edit Profile
@endsection

@push('css')
  
@endpush

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Profile
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit Profile</li>
    </ol>
  </section>

  <!-- Main content -->
 <section class="content">
  <div class="row">
      <div class="col-lg-12">
          <div class="box">

                <form action="{{ route('user.profile.update') }}" class="form-profile" data-toggle="validator" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="alert alert-info alert dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <i class="icon fa fa-check"> Perubahan Berhasil disimpan</i>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Email</label>
                            <div class="col-lg-6">

                                <input type="text" class="form-control" name="email" id="email" disabled value="{{ $profile->email }}">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Nama</label>
                            <div class="col-lg-6">

                                <input type="text" class="form-control" name="name" id="name" value="{{ $profile->name }}"  required autofocus >
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                    
                                       

                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Foto Profile</label>
                            <div class="col-lg-6">

                                <input type="file" class="form-control" name="foto" id="foto" onchange="preview('.tampil-foto',this.files[0])">
                                <span class="help-block with-errors"></span><br>
                                <div class="tampil-foto">
                                    <img src="{{ asset($profile->foto ?? '') }}" width="200px">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-2 control-label col-lg-offset-1">Password Lama</label>
                            <div class="col-lg-6">

                                <input type="password" class="form-control" name="old_password" id="old_password" >
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 control-label col-lg-offset-1">Password Baru</label>
                            <div class="col-lg-6">

                                <input type="password" class="form-control" name="password" id="password" >
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-2 control-label col-lg-offset-1">Password konfirmasi</label>
                            <div class="col-lg-6">

                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"  data-match="#password"   >
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
       $('#old_password').on('keyup', function(){
           if($(this).val() != "") $('#password').attr('required',true);
           else $('#password').attr('required',false);
       });

     
        
        $('.form-profile').validator().on('submit',function(e){
            if(! e.preventDefault()){
                $.ajax({
                    url: $('.form-profile').attr('action'),
                    type: $('.form-profile').attr('method'),
                    data: new FormData($('.form-profile')[0]),
                    async: false,
                    processData: false,
                    contentType: false,
                })
                .done(user => {
                    $('#email').val(user.email);
                    $('#name').val(user.name);
            
                    $('.tampil-foto').html(`<img src="{{ url('/') }}/${user.foto}" width="200px">`);
                    $('.alert').fadeIn();
                    $('.img-profil').attr('src', `{{ url('/') }}/${user.foto}`);

                    setTimeout(() => {
                        $('.alert').fadeOut();
                    }, 3000);
                })
                .fail(errors => {
                    if(errors.status == 422){
                        alert(errors.responseJSON);
                    }else{
                        alert('tidak dapat menyimpan data');
                    }
                    return;
                });
            }
        });
    });


</script>
@endpush
