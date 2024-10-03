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
    public function index()
    {
        $perPage = 10; // Số bản ghi trên mỗi trang

        // Sử dụng phương thức paginate để lấy dữ liệu phân trang
        $categories = Category::where('Xoa', null)->paginate($perPage);
        return view('categories.index',compact('categories', ),[
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
