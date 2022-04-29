<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting.index');
    }

    public function show()
    {
        return Setting::first();
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $setting->company_name = $request->company_name;
        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->discount = $request->discount;
        $setting->nota_type = $request->nota_type;

        if($request->hasFile('path_logo')){
            $image = $request->file('path_logo');
            $nama = 'logo-'.date('Y-m-dHis').'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/img/'),$nama);

            $setting->path_logo = 'img/'.$nama;
        }

        if($request->hasFile('path_member')){
            $image = $request->file('path_member');
            $nama = 'member-'.date('Y-m-dHis').'.'. $image->getClientOriginalExtension();

            $image->move(public_path('/img/'),$nama);

            $setting->path_member = 'img/'.$nama;
        }

        $setting->update();

        return response()->json('data berhasil di update',200);

    }
}
