<?php

namespace App\Http\Controllers;

use App\Models\Changer;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.member.index');
    }

    public function data()
    {
        $member = Member::orderBy('member_code','asc')->get();

        return datatables()
            ->of($member)//source
            ->addIndexColumn() //untuk nomer
            ->addColumn('created_at', function ($member) {
                return formatTanggal($member->created_at,false);
            })
            
            ->addColumn('select_all', function($member){
                return '<input type="checkbox" name="id_member[]" value="'.$member->id.'">';
            })
            ->addColumn('member_code', function($member){
                return '<span class="label label-info">'.$member->member_code.'</span>';
            })
            ->addColumn('phone', function($member){
                return '<a href="https://api.whatsapp.com/send/?phone='.$member->phone.'&text&app_absent=0" target="_blank">'.$member->phone.'</a>';
            })
            ->addColumn('tanggal_lahir', function ($member) {
                return formatTanggal($member->tanggal_lahir,false);
            })
            ->addColumn('aksi', function($member){ //untuk aksi
                $button = '<div class="btn-group"><button type="button" onclick="editForm(`'.route('member.update', $member->id).'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button><button  type="button" onclick="deleteData(`'.route('member.destroy', $member->id).'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button> </div>';

               return $button;
               
            })
            ->rawColumns(['aksi','member_code','select_all','phone'])//biar kebaca
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
        $member = Member::latest()->first() ?? new Member();
        $request['member_code'] = 'M'. tambahNolDepan((int)$member->id+1, 6);

        $member = Member::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return response()->json($member);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        $member->update($request->all());

        return response()->json('Member Berhasil Disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();

        $changer = Changer::where('id_member', $id)->get();

        foreach ($changer as $row) {
            $row->delete();
        }

        return response()->json('data berhasil dihapus');
    }

    public function cetakBarcode(Request $request)
    {
        $datamember =  collect(array());

        foreach($request->id_member as $id ){
            $member = Member::find($id);
            $datamember[] = $member;
        }
        $datamember = $datamember->chunk(2); //mecah array

        $setting = Setting::first();

        $pdf = PDF::loadView('backend.member.barcode', compact('datamember','setting'));

        $pdf->setPaper(array(0,0,566.93,750.39),'potrait');

        return $pdf->stream('member.pdf');

    }
}


