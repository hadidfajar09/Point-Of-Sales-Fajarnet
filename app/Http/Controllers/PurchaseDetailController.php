<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_purchase = session('id_purchase');
        $products = Product::orderBy('product_code', 'asc')->get();
        $supplier = Supplier::find(session('id_supplier'));

        if (!$supplier) {
            abort(404);
        }

        return view('backend.purchase_detail.index', compact('id_purchase', 'products', 'supplier'));
    }

    public function data($id)
    {
        $purchase_detail = PurchaseDetail::with('product')->where('id_purchase', $id)->get();

        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($purchase_detail as $item) {
            $row = array();
            $row['product_code'] = '<span class="label label-success">' . $item->product->product_code . '</span>';
            $row['product'] = $item->product['product_name'];
            $row['price_purchase'] = 'Rp. ' . formatUang($item->price_purchase);
            $row['amount'] = '<input type="number" class="form-control input-sm qty" data-id="' . $item->id . '" min="1" max="10000" value="' . $item->amount . '">';
            $row['subtotal'] = 'Rp. ' . formatUang($item->subtotal);
            $row['aksi'] = '<div class="btn-group"><button onclick="deleteData(`' . route('purchase-detail.destroy', $item->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

            $data[] = $row;
            $total += $item->price_purchase * $item->amount;
            $total_item += $item->amount;
        }

        $data[] = [
            'product_code' => '<div class="total hide">' . $total . '</div> <div class="total_item hide">' . $total_item . '</div>',
            'product' => '',
            'price_purchase' => '',
            'amount' => '',
            'subtotal' => '',
            'aksi' => '',
        ];


        return datatables()
            ->of($data) //source
            ->addIndexColumn()
            ->rawColumns(['aksi', 'amount', 'product_code'])
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
        $products = Product::where('id', $request->id_product)->first();

        if (!$products) {
            return response()->json('Data Gagal disimpan', 400);
        }
        $detail = new PurchaseDetail();
        $detail->id_purchase = $request->id_purchase;
        $detail->id_product = $products->id;
        $detail->price_purchase = $products->purchase_price;
        $detail->amount = 1;
        $detail->subtotal = $products->purchase_price;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detail = PurchaseDetail::find($id);
        $detail->amount = $request->amount;
        $detail->subtotal = $detail->price_purchase * $request->amount;
        $detail->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listProduct = PurchaseDetail::find($id);
        $listProduct->delete();

        return response(null, 204);
    }

    public function loadForm($discount, $total)
    {
        $pay = $total - ($discount / 100 * $total);
        $data = [
            'totalrp' => formatUang($total),
            'pay' => $pay,
            'bayarrp' => formatUang($pay),
            'terbilang' => ucwords(terbilang($pay).' Rupiah') 
        ];

        return response()->json($data);
    }
}
