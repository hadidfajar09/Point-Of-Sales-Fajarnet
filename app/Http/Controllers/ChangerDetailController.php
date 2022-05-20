<?php

namespace App\Http\Controllers;

use App\Models\Changer;
use App\Models\ChangerDetail;
use App\Models\Product;
use App\Models\Member;
use Illuminate\Http\Request;

class ChangerDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_changer = session('id_changer');
        $products = Product::leftJoin('categories', 'categories.id', 'products.id_category')
        ->select('products.*','category_name')->where('poin', '!=', 0)->orderBy('product_code', 'asc')->get();
        $member = Member::find(session('id_member'));
        $discount = Changer::find($id_changer)->discount ?? 0;

        if (!$member) {
            abort(404);
        }

        return view('backend.changer_detail.index', compact('id_changer', 'products', 'member', 'discount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data($id)
    {
        $changer_detail = ChangerDetail::with('product')->where('id_changer', $id)->get();

        $data = array();
        $total = 0;
        $total_item = 0;
        $jumlah_poin = 0;

        foreach ($changer_detail as $item) {
            $row = array();
            $row['product_code'] = '<span class="label label-success">' . $item->product->product_code . '</span>';
            $row['product'] = $item->product['product_name'];
            $row['price_sale'] = 'Rp. ' . formatUang($item->price_sale);
            $row['amount'] = '<input type="number" class="form-control input-sm qty" data-id="' . $item->id . '" min="1" max="10000" value="' . $item->amount . '">';
            $row['subtotal'] = 'Rp. ' . formatUang($item->subtotal);
            $row['total_poin'] = formatUang($item->total_poin);
            $row['aksi'] = '<div class="btn-group"><button onclick="deleteData(`' . route('changer-detail.destroy', $item->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

            $data[] = $row;
            $total += $item->price_sale * $item->amount;
            $total_item += $item->amount;
            $jumlah_poin += $item->total_poin * $item->amount;
            
        }

        $data[] = [
            'product_code' => '<div class="total hide">' . $total . '</div> <div class="total_item hide">' . $total_item . '</div> <div class="jumlah_poin hide">' . $jumlah_poin . '</div>',
            'product' => '',
            'price_sale' => '',
            'amount' => '',
            'subtotal' => '',
            'total_poin' => '',
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
        $detail = new ChangerDetail();
        $detail->id_changer = $request->id_changer;
        $detail->id_product = $products->id;
        $detail->price_sale = $products->sale_price;
        $detail->amount = 1;
        $detail->subtotal = $products->sale_price;
        $detail->total_poin = $products->poin;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
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
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detail = ChangerDetail::find($id);
        $detail->amount = $request->amount;
        $detail->subtotal = $detail->price_sale * $request->amount;

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
        $listProduct = ChangerDetail::find($id);
        $listProduct->delete();

        return response(null, 204);
    }

    public function loadForm($discount, $total, $jumlah_poin)
    {
        $pay = $total - ($discount / 100 * $total);
        $member = Member::find(session('id_member'));

        $data = [
            'totalrp' => formatUang($total),
            'bayar' => round($pay),
            'bayarrp' => formatUang($pay),
            'terbilang' => ucwords(terbilang($pay).' Rupiah') ,
            'jumlah_poin' => $jumlah_poin,
            'sisa_poin' => $member->poin - $jumlah_poin
        ];

        return response()->json($data);
    }
}

