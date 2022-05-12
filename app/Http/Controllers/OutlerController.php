<?php

namespace App\Http\Controllers;

use App\Models\Outler;
use App\Models\User;
use Illuminate\Http\Request;

class OutlerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.outlet.index');
    }

    public function data()
    {
        $outlet = Outler::orderBy('id','desc')->get();

        return datatables()
            ->of($outlet)//source
            ->addIndexColumn() //untuk nomer
            ->addColumn('aksi', function($outlet){ //untuk aksi
                $button = '<div class="btn-group"><button onclick="editForm(`'.route('outlet.update', $outlet->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button><button onclick="deleteData(`'.route('outlet.destroy', $outlet->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

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
        $outlet = new Outler();
        $outlet->nama_outlet = $request->nama_outlet;
        $outlet->alamat = $request->alamat;
        $outlet->save();

        return response()->json('Outlet Berhasil Disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlet = Outler::find($id);
        return response()->json($outlet);
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
        $outlet = Outler::find($id);
        $outlet->nama_outlet = $request->nama_outlet;
        $outlet->update();

        return response()->json('Outlet Berhasil Disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet = Outler::find($id);
        // $kasir = User::where('id_outlet', $id)->get();

        // foreach ($kasir as $row) {
        //     $row->delete();
        // }

        $outlet->delete();

        return response()->json('data berhasil dihapus');
    }
}
