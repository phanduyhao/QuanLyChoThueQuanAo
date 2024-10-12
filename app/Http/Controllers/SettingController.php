<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tencuahang = Setting::where('setting_code', 'ten_cua_hang')->value('value');
        $sdt = Setting::where('setting_code', 'sdt')->value('value');
        $stk = Setting::where('setting_code', 'stk')->value('value');
        $dia_chi = Setting::where('setting_code', 'dia_chi')->value('value');
        $link_qr = Setting::where('setting_code', 'link_qr_code')->value('value');
        $ghi_chu = Setting::where('setting_code', 'ghi_chu')->value('value');

        return view('setting.index',compact('tencuahang','sdt','stk','link_qr','ghi_chu','dia_chi'),[
            'title' => 'Cấu hình'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Lấy các giá trị từ form
        $data = $request->only(['ten_cua_hang', 'sdt', 'stk','dia_chi', 'link_qr_code', 'ghi_chu']);
    
        // Kiểm tra và cập nhật từng cài đặt
        foreach ($data as $key => $value) {
            $settingItem = Setting::where('setting_code', $key)->first();
            if ($settingItem) {
                $settingItem->value = $value;
                $settingItem->save();
            }
        }
    
        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
