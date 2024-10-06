<?php

namespace App\Http\Controllers;

use App\Models\Kho;
use App\Models\Chothue_Product;
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
        $perPage = 10;
        $products = Product::where('Xoa', null)->get()->map(function ($product) {
            // Tính tổng số lượng đã nhập cho sản phẩm này
            $totalInStock = Kho::where('Xoa', null)
                                ->where('id_product', $product->id)
                                ->sum('quantity');
    
            // Số lượng còn lại có thể nhập
            $availableQuantity = $product->quantity_origin - $totalInStock;
    
            // Gán giá trị mới cho sản phẩm để sử dụng trong view
            $product->available_quantity = $availableQuantity;
    
            return $product;
        });
    
        $khos = Kho::where('Xoa', null)->paginate($perPage);
        // Tính số lượng rảnh và số lượng đang cho thuê cho từng kho
        foreach ($khos as $kho) {
            // Tổng số lượng trong kho
            $kho->total_quantity = $kho->quantity;

            // Số lượng đang cho thuê từ bảng Chothue_Product
            $kho->quantity_rented = Chothue_Product::where('id_product_theokho', $kho->id)->sum('quantity');

            // Số lượng rảnh là tổng số lượng trừ đi số lượng đang cho thuê
            $kho->quantity_available = $kho->total_quantity - $kho->quantity_rented;
        }
        return view('khos.index', compact('khos', 'products'), [
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
    
        // Tính tổng số lượng sản phẩm đã có trong kho
        $totalInStock = Kho::where('Xoa', null)
        ->where('id_product', $request->id_product)
        ->sum('quantity');

        // Kiểm tra nếu số lượng yêu cầu vượt quá số lượng gốc trừ đi số lượng đã nhập
        $availableQuantity = $product->quantity_origin - $totalInStock;

        if ($request->quantity > $availableQuantity) {
            return redirect()->back()->withErrors([
                'quantity' => 'Số lượng nhập vượt quá số lượng còn lại của sản phẩm! Bạn chỉ có thể nhập tối đa ' . $availableQuantity . ' cái nữa.'
            ]);
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
        // Validate input
        $this->validate($request, [
            'title' => 'required',
            'id_product' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1'
        ], [
            'title.required' => 'Vui lòng nhập tên kho!',
            'id_product.required' => 'Vui lòng chọn sản phẩm!',
            'quantity.required' => 'Vui lòng nhập số lượng!',
            'quantity.numeric' => 'Số lượng phải là số!',
            'quantity.min' => 'Số lượng phải lớn hơn 0!',
        ]);
    
        // Lấy thông tin sản phẩm
        $product = Product::find($request->id_product);
    
        if (!$product) {
            return redirect()->back()->withErrors(['id_product' => 'Sản phẩm không tồn tại!']);
        }
    
        // Tính tổng số lượng sản phẩm đã có trong các kho (ngoại trừ kho hiện tại)
        $totalInStock = Kho::where('Xoa', null)
                            ->where('id_product', $request->id_product)
                            ->where('id', '!=', $kho->id) // Bỏ qua kho hiện tại
                            ->sum('quantity');
    
        // Kiểm tra nếu số lượng yêu cầu vượt quá số lượng gốc trừ đi số lượng đã nhập
        $availableQuantity = $product->quantity_origin - $totalInStock;
    
        if ($request->quantity > $availableQuantity) {
            return redirect()->back()->withErrors([
                'quantity' => 'Số lượng nhập vượt quá số lượng còn lại của sản phẩm! Bạn chỉ có thể nhập tối đa ' . $availableQuantity . ' cái nữa.'
            ]);
        }
    
        // Cập nhật kho sau khi đã kiểm tra
        $kho->title = $request->title;
        $kho->id_product = $request->id_product;
        $kho->quantity = $request->quantity;
        $kho->desc = $request->desc;
        $kho->save();
    
        return redirect()->back()->withInput()->with('edit_kho_id', $kho->id);
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
