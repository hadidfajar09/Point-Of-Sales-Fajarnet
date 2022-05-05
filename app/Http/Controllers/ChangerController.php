<?php

namespace App\Http\Controllers;

use App\Models\Changer;
use App\Models\ChangerDetail;
use App\Models\Product;
use App\Models\Member;
use Illuminate\Http\Request;

class ChangerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = Member::orderBy('poin','desc')->get();
        return view('backend.changer.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $changer = Changer::orderBy('id','desc')->get();

        return datatables()
            ->of($changer)//source
            ->addIndexColumn() //untuk nomer
            ->addColumn('created_at', function($changer){
                return formatTanggal($changer->created_at);
            })
            ->addColumn('member', function($changer){
                return $changer->member['name'];
            })
            ->addColumn('total_price', function($changer){
                return 'Rp. ' . formatUang($changer->total_price);
            })
            ->addColumn('discount', function($changer){
                return $changer->discount .' %';
            })
            ->addColumn('pay', function($changer){
                return 'Rp. ' . formatUang($changer->pay);
            })
            ->addColumn('total_poin', function($changer){
                return formatUang($changer->total_poin);
            })
            ->addColumn('aksi', function($changer){ //untuk aksi
                $button = '<div class="btn-group"><button onclick="detailForm(`'.route('changer.show', $changer->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button><button onclick="deleteData(`'.route('changer.destroy', $changer->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

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
    public function create($id)
    {
        $changer = new Changer();
        $changer->id_member = $id;
        $changer->total_item = 0;
        $changer->total_price = 0;
        $changer->discount = 0;
        $changer->pay = 0;
        $changer->total_poin = 0;

        $changer->save();

        session(['id_changer' => $changer->id]);
        session(['id_member' => $changer->id_member]);

        return redirect()->route('changer-detail.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $changer = Changer::findOrFail($request->id_changer);
        $changer->total_item = $request->total_item;
        $changer->total_price = $request->total;
        $changer->discount = $request->discount;
        $changer->pay = $request->bayar;
        $changer->total_poin = $request->total_poin;
        $changer->update();

        $detail = ChangerDetail::where('id_changer',$request->id_changer)->get();

        foreach($detail as $row){
            $product = Product::find($row->id_product);
            $product->stock -= $row->amount;
            $product->update();
        }

        return redirect()->route('changer.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = ChangerDetail::with('product')->where('id_changer',$id)->orderBy('id','desc')->get();

        return datatables()
        ->of($detail)//source
        ->addIndexColumn() //untuk nomer
        ->addColumn('product_code', function($detail){
            return '<span class="label label-success">'.$detail->product->product_code.'</span>';
        })
        ->addColumn('product_name', function($detail){
            return $detail->product->product_name;
        })
        ->addColumn('price_sale', function($detail){
            return 'Rp. ' . formatUang($detail->price_sale);
        })
        ->addColumn('amount', function($detail){
            return $detail->amount;
        })
        ->addColumn('subtotal', function($detail){
            return 'Rp. ' . formatUang($detail->subtotal);
        })
        ->addColumn('total_poin', function($detail){
            return formatUang($detail->total_poin);
        })
        ->rawColumns(['product_code'])//biar kebaca
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $changer = Changer::find($id);
        $detail = ChangerDetail::where('id_changer', $changer->id)->get();

        foreach($detail as $row){

            $product = Product::find($row->id_product);
            if($product){
                $product->stock += $row->amount;
                $product->update();
            }

            $row->delete();
        }
        $changer->delete();

        return response()->json('data berhasil dihapus');
    }
}
