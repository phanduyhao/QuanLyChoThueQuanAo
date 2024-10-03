<?php

namespace App\Http\Controllers;

use App\Models\Kho;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Validation\ValidatesRequests;

class KhoController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 10; // Số bản ghi trên mỗi trang
        $products = Product::where('Xoa', null)->get();
        // Sử dụng phương thức paginate để lấy dữ liệu phân trang
        $khos = Kho::where('Xoa', null)->paginate($perPage);
        return view('khos.index',compact('khos','products' ),[
            'title' => 'Quản lý kho'
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
        // Validate input trước
        $this->validate($request, [
            'title' => 'required',
            'id_product' => 'required',
            'quantity' => 'required'
        ], [
            'title.required' => 'Vui lòng nhập tên kho!',
            'id_product.required' => 'Vui lòng chọn sản phẩm!',
            'quantity.required' => 'Vui lòng nhập số lượng!'
        ]);
    
        // Kiểm tra nếu tên kho và sản phẩm đã tồn tại trong kho đó
        $existingKho = Kho::where('Xoa', null)
        ->where('title', $request->title)
        ->where('id_product', $request->id_product)
        ->first();
    
        if ($existingKho) {
            return redirect()->back()->withErrors([
                'id_product' => 'Sản phẩm (' . $existingKho->product->product_name . ') đã có trong kho (' . $existingKho->title . ')!'
            ]);
        }
        
    
        // Lấy thông tin sản phẩm
        $product = Product::find($request->id_product);
        
        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            return redirect()->back()->withErrors(['id_product' => 'Sản phẩm không tồn tại!']);
        }
    
        // Kiểm tra nếu số lượng yêu cầu vượt quá số lượng gốc của sản phẩm
        if ($request->quantity > $product->quantity_origin) {
            return redirect()->back()->withErrors(['quantity' => 'Số lượng nhập vượt quá số lượng gốc của sản phẩm!']);
        }
    
        // Tạo mới kho sau khi đã kiểm tra
        $kho = new Kho;
        $kho->title = $request->title;
        $kho->id_product = $request->id_product;
        $kho->quantity = $request->quantity;
        $kho->desc = $request->desc;
        $kho->save();
    
        return redirect()->back()->with('success', 'Kho đã được thêm thành công!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kho = Kho::find($id);

        if (!$kho) {
            return response()->json([
                'message' => 'Không tìm thấy kho với ID: ' . $id
            ], 404); 
        }

        return response()->json($kho); 
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kho $kho)
    {
        $this->validate($request, [
            'cate_name' => [
                'required',
                Rule::unique('khos')->ignore($kho->id),
            ]
        ], [
            'cate_name.required' => 'Vui lòng nhập tên Kho!',
            'cate_name.unique' => 'Kho này đã tồn tại'
        ]);
        $kho->cate_name = $request->cate_name;
        $kho->desc = $request->desc;
        $kho->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kho = Kho::find($id);

        if (!$kho) {
            return response()->json([
               'message' => 'Không tìm thấy khách hàng với ID: '. $id
            ], 404); 
        }

        $kho->Xoa = true;
        $kho->save();

        return response()->json([
           'message' => 'Đã xóa khách hàng ID: '. $id
        ], 200);
    }
}
