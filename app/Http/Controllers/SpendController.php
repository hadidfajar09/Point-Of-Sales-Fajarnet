<?php

namespace App\Http\Controllers;

use App\Models\Spend;
use Illuminate\Http\Request;

class SpendController extends Controller
{
    public function index()
    {
        return view('backend.spend.index');
    }

    public function data()
    {
        $spend = Spend::orderBy('id','desc')->get();

        return datatables()
            ->of($spend)//source
            ->addIndexColumn() //untuk nomer
            ->addColumn('created_at', function($spend){
                return formatTanggal($spend->created_at);
            })
            ->addColumn('nominal', function($spend){
                $rp = 'Rp. ';
                $format = formatUang($spend->nominal);
                return $rp . $format;
            })
            ->addColumn('aksi', function($spend){ //untuk aksi
                $button = '<div class="btn-group"><button onclick="editForm(`'.route('spend.update', $spend->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button><button onclick="deleteData(`'.route('spend.destroy', $spend->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';
               return $button;
            })
            ->rawColumns(['aksi'])//biar kebaca
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $spend = Spend::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spend = Spend::find($id);
        return response()->json($spend);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function edit(Spend $spend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $spend = Spend::find($id);
        $spend->update($request->all());

        return response()->json('Pengeluaran Berhasil Disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spend  $spend
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spend = Spend::find($id);
        $spend->delete();

        return response()->json('data berhasil dihapus');
    }
}
