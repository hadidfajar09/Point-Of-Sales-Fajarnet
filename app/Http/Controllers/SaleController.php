<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use function PHPUnit\Framework\returnSelf;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.sale.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data()
    {
        $sale = Sale::orderBy('id','desc')->get();

        return datatables()
            ->of($sale)//source
            ->addIndexColumn() //untuk nomer
            ->addColumn('created_at', function($sale){
                return formatTanggal($sale->created_at);
            })
            ->addColumn('member', function($sale){
                $member = $sale->member['member_code'] ?? '';
                return '<span class="label label-success">'.$member.'</span>';
            })
            ->addColumn('total_price', function($sale){
                return 'Rp. ' . formatUang($sale->total_price);
            })
            ->addColumn('discount', function($sale){
                return $sale->discount .' %';
            })
            ->addColumn('pay', function($sale){
                return 'Rp. ' . formatUang($sale->pay);
            })
            ->addColumn('kasir', function($sale){
                return $sale->user['name'];
            })
            ->addColumn('aksi', function($sale){ //untuk aksi
                $button = '<div class="btn-group"><button onclick="detailForm(`'.route('sale.show', $sale->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button><button onclick="deleteData(`'.route('sale.destroy', $sale->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';
 
               return $button;
               
            })
            ->rawColumns(['aksi','member'])//biar kebaca
            ->make(true);
    }

    public function create()
    {
        $sale = new Sale();
        $sale->id_member = null;
        $sale->id_user = Auth::user()->id;
        $sale->total_item = 0;
        $sale->total_price = 0;
        $sale->discount = 0;
        $sale->pay = 0;
        $sale->accepted = 0;
        $sale->save();

        session(['id_sale' => $sale->id]);

        return redirect()->route('transaksi.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = Sale::findOrFail($request->id_sale);
        $sale->id_member = $request->id_member;
        $sale->total_item = $request->total_item;
        $sale->total_price = $request->total;
        $sale->discount = $request->discount;
        $sale->pay = $request->bayar;
        $sale->accepted = $request->diterima;
        $sale->update();

        $poin = $request->total / 25000;
        $member = Member::findOrFail($request->id_member);
        $member->poin += $poin;
        $member->update();

        $detail = SaleDetail::where('id_sale',$request->id_sale)->get();

        foreach($detail as $row){
            $product = Product::find($row->id_product);
            $product->stock -= $row->amount;
            $product->update();
        }

        return redirect()->route('transaksi.selesai');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = SaleDetail::with('product')->where('id_sale',$id)->orderBy('id','desc')->get();

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
        ->rawColumns(['product_code'])//biar kebaca
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $detail = SaleDetail::where('id_sale', $sale->id)->get();

        foreach($detail as $row){

            $product = Product::find($row->id_product);
            if($product){
                $product->stock += $row->amount;
                $product->update();
            }

            $row->delete();
        }
        $sale->delete();

        return response()->json('data berhasil dihapus');
    }

    public function notaKecil()
    {
        $setting = Setting::first();
        $sale = Sale::find(session('id_sale'));

        if (!$sale) {
            abort(404);
        }

        $detail = SaleDetail::with('product')->where('id_sale',session('id_sale'))->get();

        return view('backend.sale.nota_kecil',compact('setting','detail','sale'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $sale = Sale::find(session('id_sale'));

        if (!$sale) {
            abort(404);
        }

        $detail = SaleDetail::with('product')->where('id_sale',session('id_sale'))->get();

        $pdf = PDF::loadView('backend.sale.nota_besar', compact('setting','sale','detail'));
        $pdf->setPaper(0,0,609,440, 'potrait');

        return $pdf->stream(date('Y-m-d-his') . ' Nota Transaksi.pdf');
    }
}
