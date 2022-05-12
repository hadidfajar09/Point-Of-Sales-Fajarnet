<?php

namespace App\Http\Controllers;

use App\Models\Outler;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outler = Outler::all()->pluck('nama_outlet','id');
        return view('backend.user.index',compact('outler'));
    }

    public function data()
    {
        
        $user = User::isNotAdmin()->leftJoin('outlers', 'outlers.id', 'users.id_outler')
        ->select('users.*','nama_outlet') ->orderBy('id','desc')->get();
        return datatables()
            ->of($user)//source
            ->addIndexColumn() //untuk nomer
            ->addColumn('aksi', function($user){ //untuk aksi
                $button = '<div class="btn-group"><button onclick="editForm(`'.route('user.update', $user->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button><button onclick="deleteData(`'.route('user.destroy', $user->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_outler = $request->id_outler;
        $user->password = bcrypt($request->password);
        $user->level = 1;
        $user->foto = '/img/user.jpg';

        $user->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_outler = $request->id_outler;

        if($request->has('password') && $request->password != ""){
            $user->password = bcrypt($request->password);
        }
        $user->update();

        return response()->json('Member Berhasil Disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $sale = Sale::where('id_user', $id)->get();

        foreach ($sale as $row) {
            $row->delete();
        }

        return response()->json('data berhasil dihapus');
    }

    public function profile()
    {   
        $profile = Auth::user();
        return view('backend.user.profile',compact('profile'));
    }

    public function updateProfile(Request $request)
    {

        $profile = Auth::user();

        $profile->name = $request->name;
        
        if($request->has('password') && $request->password != ""){
            if(Hash::check($request->old_password, $profile->password)){
                if($request->password == $request->password_confirmation){
                    $profile->password = bcrypt($request->password);
                } else{
                    return response()->json('Password konfirmasi tidak sesuai',422);
                }
            }
            else{
                return response()->json('Password lama tidak sesuai',422);
            }
        }

        if($request->hasFile('foto')){
            $image = $request->file('foto');
            $nama = 'logo-'.date('Y-m-dHis').'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/img/'),$nama);

            $profile->foto = 'img/'.$nama;
        }

        $profile->update();

        return response()->json($profile,200);
    }
}
