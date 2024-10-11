<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Customer;
use App\Models\Chothue;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $count_customer = Customer::where('Xoa', null)->count();
        $count_admin = User::count();
        $count_chothue = Chothue::where('Xoa', null)->count();
        $count_cate = Category::where('Xoa', null)->count();
        $count_product = Product::where('Xoa', null)->count();
        $totalQuantityProduct = Product::sum('quantity_origin');
        return view('home',compact('count_customer', 'count_admin','count_chothue', 'count_cate','count_product','totalQuantityProduct'),[
            'title' => 'Home',
        ]);
    }
}
