<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Spend;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggalAwal = date('Y-m-d', mktime(0,0,0,date('m'),1,date('Y')));
        $tanggalAkhir = date('Y-m-d');
        return view('backend.report.index', compact('tanggalAwal','tanggalAkhir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function data($awal,$akhir)
     {
        $no = 0;
        $data = array();
        $pendapatan = 0;
        $totalPendapatan = 0;

        while(strtotime($awal) <= strtotime($akhir)){
            $tanggal = $awal;

            $awal = date('Y-m-d', strtotime("+1 day",strtotime($awal)));

            $total_penjualan = Sale::where('created_at', 'LIKE', "%$tanggal%")->sum('pay');
            $total_pembelian = Purchase::where('created_at', 'LIKE', "%$tanggal%")->sum('pay');
            $total_pengeluaran = Spend::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');

            $pendapatan = $total_penjualan - $total_pembelian - $total_pengeluaran;
            $totalPendapatan += $pendapatan;

            $row = array();
            $row['tanggal'] = formatTanggal($tanggal);
            $row['penjualan'] = formatUang($total_penjualan);
            $row['pembelian'] = formatUang($total_pembelian);
            $row['pengeluaran'] = formatUang($total_pengeluaran);
            $row['pendapatan'] = formatUang($pendapatan);

            $data[] = $row;

        }

        $data[] = [
            'tanggal' => '',
            'penjualan' => '',
            'pembelian' => '',
            'pengeluaran' => 'Total Pendapatan',
            'pendapatan' => formatUang($totalPendapatan),
        ];


        return datatables()
        ->of($data)
        ->addIndexColumn()
        ->make(true);
            
     }
     
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
