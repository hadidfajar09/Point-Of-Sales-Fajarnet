@extends('layouts.master')

@section('title')
Tidak Ditemukan
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  

  <!-- Main content -->
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-purple"> 404</h2>

      <div class="error-content">
        <h3><i class="fa fa-info text-purple"></i> Oops! Page not found.</h3>

        <p>
          We could not find the page you were looking for.
          Meanwhile, you may <a href="{{ url('/') }}">return to dashboard</a> or try using the search form.
        </p>

        <form class="search-form">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search">

            <div class="input-group-btn">
              <button type="submit" name="submit" class="btn btn-purple btn-flat"><i class="fa fa-search"></i>
              </button>
            </div>
          </div>
          <!-- /.input-group -->
        </form>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
  <!-- /.content -->
</div>

@endsection
