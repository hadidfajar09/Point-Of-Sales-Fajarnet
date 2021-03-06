<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset(Auth::user()->foto) }}" class="img-circle img-profil" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

      </ul>
      
      
          
      
      <ul class="sidebar-menu" data-widget="tree">

        @if (auth()->user()->level == 0)
        <li class="header">MASTER</li>
        <li><a href="{{ route('category.index') }}"><i class="fa fa-cube"></i> <span>Kategori</span></a></li>
        <li><a href="{{ route('product.index') }}"><i class="fa fa-cubes"></i> <span>Produk</span></a></li>
        <li><a href="{{ route('member.index') }}"><i class="fa fa-id-card"></i> <span>Member</span></a></li>
        <li><a href="{{ route('supplier.index') }}"><i class="fa fa-users"></i> <span>Supplier</span></a></li>
        
        <li class="header">TRANSAKSI</li>
        <li><a href="{{ route('spend.index') }}"><i class="fa fa-download"></i> <span>Pengeluaran</span></a></li>
        <li><a href="{{ route('purchase.index') }}"><i class="fa fa-upload"></i> <span>Pembelian</span></a></li>
        <li><a href="{{ route('sale.index') }}"><i class="fa fa-cart-plus"></i> <span>Penjualan</span></a></li>
        <li><a href="{{ route('transaksi.index') }}"><i class="fa fa-bookmark-o"></i> <span>Transaksi Aktif</span></a></li>
        <li><a href="{{ route('transaksi.baru') }}"><i class="fa fa-bookmark"></i> <span>Transaksi Baru</span></a></li>
        <li><a href="{{ route('changer.index') }}"><i class="fa fa-money"></i> <span>Penukaran Poin</span></a></li>

        <li class="header">REPORT</li>
        <li><a href="{{ route('laporan.index') }}"><i class="fa fa-book"></i> <span>Laporan</span></a></li>

        <li class="header">SYSTEM</li>
        <li><a href="{{ route('outlet.index') }}"><i class="fa fa-map-marker"></i> <span>Outlet</span></a></li>
        <li><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> <span>Kasir</span></a></li>
        <li><a href="{{ route('setting.index') }}"><i class="fa fa-cogs"></i> <span>Pengaturan</span></a></li>
       
        @else

        <li><a href="{{ route('member.index') }}"><i class="fa fa-id-card"></i> <span>Member</span></a></li>
        <li><a href="{{ route('sale.index') }}"><i class="fa fa-cart-plus"></i> <span>Penjualan</span></a></li>
        <li><a href="{{ route('transaksi.index') }}"><i class="fa fa-bookmark-o"></i> <span>Transaksi Aktif</span></a></li>
        <li><a href="{{ route('transaksi.baru') }}"><i class="fa fa-bookmark"></i> <span>Transaksi Baru</span></a></li>
        <li><a href="{{ route('changer.index') }}"><i class="fa fa-money"></i> <span>Penukaran Poin</span></a></li>

        @endif
      
      </ul>
      
    </section>
    <!-- /.sidebar -->
  </aside>