<?php

namespace App\Http\Controllers;

use App\Models\Doanhthu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoanhthuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchKhoName = $request->input('search_kho_name');

        $tongDoanhThuThucTe = DB::table('doanhthus')
            ->join('chothues', 'doanhthus.id_chothue', '=', 'chothues.id')
            ->whereNull('chothues.Xoa')
            ->sum('doanhthus.doanh_thu_thuc_te');

        $tongDoanhThuDuKien = DB::table('doanhthus')
            ->join('chothues', 'doanhthus.id_chothue', '=', 'chothues.id')
            ->whereNull('chothues.Xoa')
            ->sum('doanhthus.doanh_thu_du_kien');

        $tongTienThieu = $tongDoanhThuDuKien - $tongDoanhThuThucTe;

        $doanhThuTheoKho = DB::table('doanhthus')
            ->join('khos', 'doanhthus.id_kho', '=', 'khos.id')
            ->join('chothues', 'doanhthus.id_chothue', '=', 'chothues.id')
            ->whereNull('chothues.Xoa')
            ->when($searchKhoName, function ($query, $searchKhoName) {
                return $query->where('khos.title', 'like', '%' . $searchKhoName . '%');
            })
            ->select(
                'khos.title as ten_kho',
                DB::raw('SUM(doanhthus.doanh_thu_thuc_te) as tong_doanh_thu_thuc_te'),
                DB::raw('SUM(doanhthus.doanh_thu_du_kien) as tong_doanh_thu_du_kien'),
                DB::raw('SUM(doanhthus.doanh_thu_du_kien) - SUM(doanhthus.doanh_thu_thuc_te) as tien_thieu')
            )
            ->groupBy('khos.title')
            ->paginate(20);

        return view('doanhthu.index', compact('doanhThuTheoKho', 'tongDoanhThuThucTe', 'tongDoanhThuDuKien', 'tongTienThieu'), [
            'title' => 'Doanh thu theo KHO',
            'searchKhoName' => $searchKhoName // Để giữ giá trị tìm kiếm trong view
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
    public function show(Doanhthu $doanhthu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doanhthu $doanhthu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doanhthu $doanhthu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doanhthu $doanhthu)
    {
        //
    }
}
