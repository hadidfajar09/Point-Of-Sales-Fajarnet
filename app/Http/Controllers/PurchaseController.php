<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::orderBy('id','desc')->get();

        return view('backend.purchase.index', compact('supplier'));
    }

    public function data()
    {
        $purchase = Purchase::orderBy('id','desc')->get();

        return datatables()
            ->of($purchase)//source
            ->addIndexColumn() //untuk nomer
            ->addColumn('created_at', function($purchase){
                return formatTanggal($purchase->created_at);
            })
            ->addColumn('supplier', function($purchase){
                return $purchase->supplier['name'];
            })
            ->addColumn('total_price', function($purchase){
                return 'Rp. ' . formatUang($purchase->total_price);
            })
            ->addColumn('discount', function($purchase){
                return $purchase->discount .' %';
            })
            ->addColumn('pay', function($purchase){
                return 'Rp. ' . formatUang($purchase->pay);
            })
            ->addColumn('aksi', function($purchase){ //untuk aksi
                $button = '<div class="btn-group"><button onclick="detailForm(`'.route('purchase.show', $purchase->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button><button onclick="deleteData(`'.route('purchase.destroy', $purchase->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

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

