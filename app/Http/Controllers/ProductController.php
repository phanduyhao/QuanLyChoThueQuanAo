<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 20; // Số bản ghi trên mỗi trang
        $cates = Category::where('Xoa', null)->get(); // Lấy danh sách các danh mục
        
        // Tạo query cơ bản để lấy các sản phẩm chưa bị xóa
        $query = Product::where('Xoa', null);
    
        // Kiểm tra điều kiện tìm kiếm
        if ($request->has('search_id') && $request->search_id) {
            $query->where('id', $request->search_id);
        }
        if ($request->has('search_name') && $request->search_name) {
            $query->where('product_name', 'LIKE', '%' . $request->search_name . '%');
        }
        if ($request->has('search_size') && $request->search_size) {
            $query->where('size', 'LIKE', '%' . $request->search_size . '%');
        }
        if ($request->input('search_category')) {
            // Đổi 'category_id' thành tên cột chính xác trong bảng 'products', ví dụ 'cate_id'
            $query->where('cate_id', $request->input('search_category'));
        }
    
        // Lấy danh sách sản phẩm với phân trang và thêm các tham số tìm kiếm vào liên kết phân trang
        $products = $query->paginate($perPage)->appends($request->only('search_id', 'search_name', 'search_size', 'search_category'));
    
        return view('products.index', compact('products', 'cates'), [
            'title' => 'Quản lý sản phẩm'
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
        $this->validate($request,[
            'product_name' => 'required|unique:products',
            'price_1_day' => 'required',
        ],[
            'product_name.required' => 'Vui lòng nhập tên sản phẩm!',
            'product_name.unique' => 'Sản phẩm này đã có!',
            'price_1_day.required' => 'Vui lòng nhập giá',
        ]);
        // Kiểm tra xem product_id có tồn tại trong bảng Product hay không
        $product = new Product;
        $product->product_name = $request->product_name;
        $title = $product->product_name;
        $image = $request->file('image'); // Lấy file ảnh từ file Upload
        if ($image) {
            $fileName = Str::slug($title) . '.jpg'; // Tên ảnh theo Slug Title
        //   $avatar->storeAs('public/images/avatars', $fileName); // Lưu ảnh đã thêm vào đường dẫn này
            $image->move(public_path('temp/images/product'), $fileName); // Di chuyển ảnh vào thư mục này

            $product->image = $fileName; // Lưu tên file ảnh theo slug Title
        }
        $product->cate_id = $request->cate_id;
        $product->size = $request->size;
        $product->cate_id = $request->cate_id;
        $product->price_1_day = $request->price_1_day;
        $product->quantity_origin = $request->quantity_origin;
        $product->save();
        // Chuyển hướng về trang hiển thị danh sách product hoặc trang khác tùy theo yêu cầu của bạn
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Không tìm thấy sản phẩm với ID: ' . $id
            ], 404); 
        }

        return response()->json($product); 
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
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'product_name' => [
                'required',
                Rule::unique('products')->ignore($product->id),
            ],            
            'price_1_day' => 'required'
        ],[
            'product_name.required' => 'Vui lòng nhập tên sản phẩm!',
            'product_name.unique' => 'Sản phẩm này đã có!',
            'price_1_day.required' => 'Vui lòng nhập giá',
        ]);
        // Kiểm tra xem product_id có tồn tại trong bảng Product hay không
        $product->product_name = $request->product_name;
        $title = $product->product_name;
        $image = $request->file('image'); // Lấy file ảnh từ file Upload
        if ($image) {
            $fileName = Str::slug($title) . '.jpg'; // Tên ảnh theo Slug Title
        //   $avatar->storeAs('public/images/avatars', $fileName); // Lưu ảnh đã thêm vào đường dẫn này
            $image->move(public_path('temp/images/product'), $fileName); // Di chuyển ảnh vào thư mục này

            $product->image = $fileName; // Lưu tên file ảnh theo slug Title
        }
        $product->cate_id = $request->cate_id;
        $product->size = $request->size;
        $product->cate_id = $request->cate_id;
        $product->price_1_day = $request->price_1_day;
        $product->quantity_origin = $request->quantity_origin;
        $product->save();
        // Chuyển hướng về trang hiển thị danh sách product hoặc trang khác tùy theo yêu cầu của bạn
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
               'message' => 'Không tìm thấy sản phẩm với ID: '. $id
            ], 404); 
        }

        $product->Xoa = true;
        $product->save();

        return response()->json([
           'message' => 'Đã xóa sản phẩm ID: '. $id
        ], 200);
    }
}
