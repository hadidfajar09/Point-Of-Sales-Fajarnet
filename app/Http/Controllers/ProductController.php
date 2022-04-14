<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

use function PHPUnit\Framework\returnSelf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all()->pluck('category_name','id'); //untuk 

        // $category = Category::orderBy('id','desc')->get();

        return view('backend.product.index', compact('category'));
    }

    public function data()
    {
        $product = Product::leftJoin('categories', 'categories.id', 'products.id_category')
            ->select('products.*','category_name')
            ->orderBy('product_code','asc')->get();

        return datatables()
            ->of($product)//source
            ->addIndexColumn() //untuk nomer
            ->addColumn('select_all', function($product){
                return '<input type="checkbox" name="id_product[]" value="'.$product->id.'">';
            })
            ->addColumn('product_code', function($product){
                return '<span class="label label-success">'.$product->product_code.'</span>';
            })
            ->addColumn('purchase_price', function($product){
                return formatUang($product->purchase_price);
            })
            ->addColumn('sale_price', function($product){
                return formatUang($product->sale_price);
            })
            ->addColumn('stock', function($product){
                return formatUang($product->stock);
            })
            ->addColumn('aksi', function($product){ //untuk aksi
                $button = '<div class="btn-group"><button type="button" onclick="editForm(`'.route('product.update', $product->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button><button type="button" onclick="deleteData(`'.route('product.destroy', $product->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';
               return $button;
            })
            ->rawColumns(['aksi','product_code','select_all'])//biar kebaca html
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
        $product = Product::latest()->first();
        $request['product_code'] = 'P'. tambahNolDepan((int)$product->id+1, 6);

        $product = Product::create($request->all());

        return response()->json('Kategori Berhasil Disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
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
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json('Product Berhasil Disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json('data berhasil dihapus');
    }

    public function deleteSelected(Request $request)
    {
        foreach($request->id_product as $id){
            $product = Product::find($id);
            $product->delete();
        }
        return response()->json('data berhasil dihapus');
        
    }

    public function cetakBarcode(Request $request)
    {
        $dataproduct = array();

        foreach($request->id_product as $id ){
            $product = Product::find($id);
            $dataproduct[] = $product;
        }

        $no = 1;

        $pdf = PDF::loadView('backend.product.barcode', compact('dataproduct','no'));

        $pdf->setPaper('a4','potrait');

        return $pdf->stream('product.pdf');

    }
}
