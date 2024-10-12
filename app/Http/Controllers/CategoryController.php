<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CategoryController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 20; // Số bản ghi trên mỗi trang
    
        // Tạo query cơ bản để lấy các danh mục chưa bị xóa
        $query = Category::where('Xoa', null);
    
        // Kiểm tra điều kiện tìm kiếm
        if ($request->has('search_id') && $request->search_id) {
            $query->where('id', $request->search_id);
        }
        if ($request->has('search_name') && $request->search_name) {
            $query->where('cate_name', 'LIKE', '%' . $request->search_name . '%');
        }
    
        // Lấy danh sách các danh mục với phân trang và thêm các tham số tìm kiếm vào liên kết phân trang
        $categories = $query->orderByDesc('id')->paginate($perPage)->appends($request->only('search_id', 'search_name'));
    
        return view('categories.index', compact('categories'), [
            'title' => 'Quản lý danh mục'
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
            'cate_name' => 'required|unique:categories',
            
        ],[
            'cate_name.required' => 'Vui lòng nhập tên danh mục !',
            'cate_name.unique' => 'Danh mục này đã có !',

        ]);
        $category = new Category;
        $category->cate_name = $request->cate_name;
        $category->desc = $request->desc;
        $category->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Không tìm thấy danh mục với ID: ' . $id
            ], 404); 
        }

        return response()->json($category); 
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
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'cate_name' => [
                'required',
                Rule::unique('categories')->ignore($category->id),
            ]
        ], [
            'cate_name.required' => 'Vui lòng nhập tên Danh mục!',
            'cate_name.unique' => 'Danh mục này đã tồn tại'
        ]);
        $category->cate_name = $request->cate_name;
        $category->desc = $request->desc;
        $category->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
               'message' => 'Không tìm thấy khách hàng với ID: '. $id
            ], 404); 
        }

        $category->Xoa = true;
        $category->save();

        return response()->json([
           'message' => 'Đã xóa khách hàng ID: '. $id
        ], 200);
    }
}
