<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
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
            ->addColumn('aksi', function($purchase){ //untuk aksi
                $button = '<div class="btn-group"><button onclick="editForm(`'.route('purchase.update', $purchase->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button><button onclick="deleteData(`'.route('purchase.destroy', $purchase->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
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
    public function destroy(Purchase $purchase)
    {
        //
    }
}

