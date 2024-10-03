<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CustomerController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 10; // Số bản ghi trên mỗi trang

        // Sử dụng phương thức paginate để lấy dữ liệu phân trang
        $customers = Customer::where('Xoa', null)->paginate($perPage);
        return view('customers.index',compact('customers', ),[
            'title' => 'Tài khoản khách hàng'
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
            'name' => 'required',
            'email' => 'unique:customers',
            'phone_number' => 'unique:customers',
            
        ],[
            'name.required' => 'Vui lòng nhập tên !',
            'email.unique' => 'Email này đã tồn tại',
            'phone_number.unique' => 'Số điện thoại này đã tồn tại',

        ]);
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => 'Không tìm thấy khách hàng với ID: ' . $id
            ], 404); 
        }

        return response()->json($customer); 
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
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('customers')->ignore($customer->id),
            ],
            'phone_number' => [
                'required',
                Rule::unique('customers')->ignore($customer->id),
            ],
        ], [
            'name.required' => 'Vui lòng nhập tên!',
            'email.unique' => 'Email này đã tồn tại',
            'phone_number.unique' => 'Số điện thoại này đã tồn tại',
        ]);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
               'message' => 'Không tìm thấy khách hàng với ID: '. $id
            ], 404); 
        }

        $customer->Xoa = true;
        $customer->save();

        return response()->json([
           'message' => 'Đã xóa khách hàng ID: '. $id
        ], 200);
    }
}
