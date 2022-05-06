<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Spend;

class DashboardController extends Controller
{
    public function index()
    {
        $category = Category::count();
        $product = Product::count();
        $member = Member::count();
        $kasir = User::where('level', 1)->count();

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');

        $data_tanggal = array();
        $no = 1;
        $pendapatan = 0;
        $data_pendapatan = array();

        while(strtotime($tanggal_awal) <= strtotime($tanggal_akhir)){
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);

            

            $total_penjualan = Sale::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('pay');
            $total_pembelian = Purchase::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('pay');
            $total_pengeluaran = Spend::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('nominal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $data_pendapatan[] += $pendapatan;

            $tanggal_awal = date('Y-m-d', strtotime("+1 day",strtotime($tanggal_awal)));

        }

        if(auth()->user()->level == 1){
            return view('backend.kasir.dashboard');
        } else{
            return view('backend.admin.dashboard', compact('category','product','member','kasir','tanggal_awal','tanggal_akhir','data_tanggal','data_pendapatan'));
        }
    }
}
