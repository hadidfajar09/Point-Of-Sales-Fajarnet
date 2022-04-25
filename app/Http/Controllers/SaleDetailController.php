<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('product_code','asc')->get();
        $member = Member::orderBy('name','asc')->get();
        $setting = Setting::first()->discount ?? 0;

        if( $id_sale = session('id_sale')){
            $sale = Sale::find($id_sale);
            $memberSelected =  $sale->member ?? new Member();
            return view('backend.sale_detail.index', compact('products','member','setting', 'id_sale', 'sale', 'memberSelected'));
        }

        if(Auth::user()->level == 1){
            return redirect()->route('transaksi.baru');
        }else{
            return redirect()->route('dashboard');
        }

    }

    public function data($id)
    {
        $sale_detail = SaleDetail::with('product')->where('id_sale', $id)->get();

        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($sale_detail as $item) {
            $row = array();
            $row['product_code'] = '<span class="label label-success">' . $item->product->product_code . '</span>';
            $row['product_name'] = $item->product['product_name'];
            $row['price_sale'] = 'Rp. ' . formatUang($item->price_sale);
            $row['amount'] = '<input type="number" class="form-control input-sm qty" data-id="' . $item->id . '" min="1" max="10000" value="' . $item->amount . '">';
            $row['discount'] = $item->discount.' %';
            $row['subtotal'] = 'Rp. ' . formatUang($item->subtotal);

            $row['aksi'] = '<div class="btn-group"><button onclick="deleteData(`' . route('transaksi.destroy', $item->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

            $data[] = $row;
            $total += $item->price_sale * $item->amount;
            $total_item += $item->amount;
        }

        $data[] = [
            'product_code' => '<div class="total hide">' . $total . '</div> <div class="total_item hide">' . $total_item . '</div>',
            'product_name' => '',
            'price_sale' => '',
            'amount' => '',
            'discount' => '',
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
        $detail = new SaleDetail();
        $detail->id_sale = $request->id_sale;
        $detail->id_product = $products->id;
        $detail->price_sale = $products->sale_price;
        $detail->discount = 0;
        $detail->amount = 1;
        $detail->subtotal = $products->sale_price;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detail = SaleDetail::find($id);
        $detail->amount = $request->amount;
        $detail->subtotal = $detail->price_sale * $request->amount;
        $detail->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listProduct = SaleDetail::find($id);
        $listProduct->delete();

        return response(null, 204);
    }

    public function loadForm($discount = 0, $total = 0, $diterima = 0)
    {
        $pay = $total - ($discount / 100 * $total);
        $kembali = ($diterima != 0) ? $diterima - $pay : 0;
        $poin = round($total / 25000);

        $data = [
            'totalrp' => formatUang($total),
            'bayar' => round($pay),
            'bayarrp' => formatUang($pay),
            'terbilang' => ucwords(terbilang($pay).' Rupiah'),
            'kembalirp' => formatUang($kembali),
            'kembalibilang' => ucwords(terbilang($kembali).' Rupiah'),
            'poinku' => $poin.' poin',
        ];

        return response()->json($data);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('backend.sale_detail.selesai',compact('setting'));
    }
}
