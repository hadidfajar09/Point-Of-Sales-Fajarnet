<?php

namespace App\Http\Controllers;

use App\Models\Changer;
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
        $member = Member::orderBy('id','desc')->get();

        return datatables()
            ->of($member)//source
            ->addIndexColumn() //untuk nomer
            ->addColumn('created_at', function($member){
                return formatTanggal($member->created_at);
            })
            ->addColumn('supplier', function($member){
                return $member->supplier['name'];
            })
            ->addColumn('total_price', function($member){
                return 'Rp. ' . formatUang($member->total_price);
            })
            ->addColumn('discount', function($member){
                return $member->discount .' %';
            })
            ->addColumn('pay', function($member){
                return 'Rp. ' . formatUang($member->pay);
            })
            ->addColumn('aksi', function($member){ //untuk aksi
                $button = '<div class="btn-group"><button onclick="detailForm(`'.route('member.show', $member->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button><button onclick="deleteData(`'.route('member.destroy', $member->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

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
        $purchase = new Purchase();
        $purchase->id_supplier = $id;
        $purchase->total_item = 0;
        $purchase->total_price = 0;
        $purchase->discount = 0;
        $purchase->pay = 0;

        $purchase->save();

        session(['id_purchase' => $purchase->id]);
        session(['id_supplier' => $purchase->id_supplier]);

        return redirect()->route('purchase-detail.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = Purchase::findOrFail($request->id_purchase);
        $purchase->total_item = $request->total_item;
        $purchase->total_price = $request->total;
        $purchase->discount = $request->discount;
        $purchase->pay = $request->bayar;
        $purchase->update();

        $detail = PurchaseDetail::where('id_purchase',$request->id_purchase)->get();

        foreach($detail as $row){
            $product = Product::find($row->id_product);
            $product->stock += $row->amount;
            $product->update();
        }

        return redirect()->route('purchase.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = PurchaseDetail::with('product')->where('id_purchase',$id)->orderBy('id','desc')->get();

        return datatables()
        ->of($detail)//source
        ->addIndexColumn() //untuk nomer
        ->addColumn('product_code', function($detail){
            return '<span class="label label-success">'.$detail->product->product_code.'</span>';
        })
        ->addColumn('product_name', function($detail){
            return $detail->product->product_name;
        })
        ->addColumn('price_purchase', function($detail){
            return 'Rp. ' . formatUang($detail->price_purchase);
        })
        ->addColumn('amount', function($detail){
            return $detail->amount;
        })
        ->addColumn('subtotal', function($detail){
            return 'Rp. ' . formatUang($detail->subtotal);
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
    public function edit(Purchase $purchase)
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
    public function update(Request $request, Purchase $purchase)
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
        $purchase = Purchase::find($id);
        $detail = PurchaseDetail::where('id_purchase', $purchase->id)->get();

        foreach($detail as $row){

            $product = Product::find($row->id_product);
            if($product){
                $product->stock -= $row->amount;
                $product->update();
            }

            $row->delete();
        }
        $purchase->delete();

        return response()->json('data berhasil dihapus');
    }
}
