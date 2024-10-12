<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Chothue;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(){
        $count_customer = Customer::where('Xoa', null)->count();
        $count_admin = User::count();
        $count_chothue = Chothue::where('Xoa', null)->count();
        $count_chothueDangthue = Chothue::where('Trangthai', 1)->where('Xoa', null)->count();
        $count_chothueDatra = Chothue::where('Trangthai', 0)->where('Xoa', null)->count();
        $count_cate = Category::where('Xoa', null)->count();
        $count_product = Product::where('Xoa', null)->count();
        $totalQuantityProduct = Product::sum('quantity_origin');

        $tongDoanhThuThucTe = DB::table('doanhthus')
        ->join('chothues', 'doanhthus.id_chothue', '=', 'chothues.id')
        ->whereNull('chothues.Xoa')
        ->sum('doanhthus.doanh_thu_thuc_te');

        $tongDoanhThuDuKien = DB::table('doanhthus')
        ->join('chothues', 'doanhthus.id_chothue', '=', 'chothues.id')
        ->whereNull('chothues.Xoa')
        ->sum('doanhthus.doanh_thu_du_kien');
        
        $tongTienThieu = $tongDoanhThuDuKien - $tongDoanhThuThucTe;

        $today = Carbon::today();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $tongDoanhThuThucTeHomNay = DB::table('doanhthus')
        ->join('chothues', 'doanhthus.id_chothue', '=', 'chothues.id')
        ->whereNull('chothues.Xoa')
        ->whereDate('doanhthus.created_at', $today)
        ->sum('doanhthus.doanh_thu_thuc_te');

        // Tổng doanh thu dự kiến của hôm nay
        $tongDoanhThuDuKienHomNay = DB::table('doanhthus')
        ->join('chothues', 'doanhthus.id_chothue', '=', 'chothues.id')
        ->whereNull('chothues.Xoa')
        ->whereDate('doanhthus.created_at', $today)
        ->sum('doanhthus.doanh_thu_du_kien');

        // Tổng tiền thiếu của hôm nay
        $tongTienThieuHomNay = $tongDoanhThuDuKienHomNay - $tongDoanhThuThucTeHomNay;

        // Tổng doanh thu thực tế của tháng hiện tại
        $tongDoanhThuThucTeThangNay = DB::table('doanhthus')
        ->join('chothues', 'doanhthus.id_chothue', '=', 'chothues.id')
        ->whereNull('chothues.Xoa')
        ->whereMonth('doanhthus.created_at', $currentMonth)
        ->whereYear('doanhthus.created_at', $currentYear)
        ->sum('doanhthus.doanh_thu_thuc_te');

        // Tổng doanh thu dự kiến của tháng hiện tại
        $tongDoanhThuDuKienThangNay = DB::table('doanhthus')
            ->join('chothues', 'doanhthus.id_chothue', '=', 'chothues.id')
            ->whereNull('chothues.Xoa')
            ->whereMonth('doanhthus.created_at', $currentMonth)
            ->whereYear('doanhthus.created_at', $currentYear)
            ->sum('doanhthus.doanh_thu_du_kien');

        // Tổng tiền thiếu của tháng hiện tại
        $tongTienThieuThangNay = $tongDoanhThuDuKienThangNay - $tongDoanhThuThucTeThangNay;
        return view('home',compact('count_customer','tongDoanhThuThucTeThangNay', 
        'tongDoanhThuDuKienThangNay', 
        'tongTienThieuThangNay','tongDoanhThuThucTeHomNay','tongDoanhThuDuKienHomNay','tongTienThieuHomNay', 'count_admin','count_chothue', 'count_cate','count_product','totalQuantityProduct','count_chothueDatra','count_chothueDangthue','tongTienThieu','tongDoanhThuDuKien','tongDoanhThuThucTe'),[
            'title' => 'Home',
        ]);
    }
}
