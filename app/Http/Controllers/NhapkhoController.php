<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Nhapkho;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Validation\ValidatesRequests;

class NhapkhoController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $nhapkhos = Nhapkho::where('Xoa', null)->paginate(20);

        return view('nhapkhos.index',compact('nhapkhos', 'roles'),[
            'title' => 'Tài khoản quản trị'
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
            'email' => 'unique:nhapkhos',
            'password' => 'required',
            'phone_number' => 'unique:nhapkhos',
            
        ],[
            'name.required' => 'Vui lòng nhập tên !',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'phone_number.unique' => 'Số điện thoại này đã tồn tại',

        ]);
        $nhapkho = new Nhapkho;
        $nhapkho->name = $request->name;
        $nhapkho->email = $request->email;
        $nhapkho->password = $request->password;
        $nhapkho->phone_number = $request->phone_number;
        if($request->role_id == null){
            $nhapkho->role_id = Role::CTV; 
        }else{
            $nhapkho->role_id = $request->role_id;
        }
        $nhapkho->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nhapkho = Nhapkho::find($id);

        if (!$nhapkho) {
            return response()->json([
                'message' => 'Không tìm thấy người dùng với ID: ' . $id
            ], 404); 
        }

        return response()->json($nhapkho); 
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
    public function update(Request $request, Nhapkho $nhapkho)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('nhapkhos')->ignore($nhapkho->id),
            ],
            'phone_number' => [
                'required',
                Rule::unique('nhapkhos')->ignore($nhapkho->id),
            ],
        ], [
            'name.required' => 'Vui lòng nhập tên!',
            'email.unique' => 'Email này đã tồn tại',
            'phone_number.unique' => 'Số điện thoại này đã tồn tại',
        ]);
        $nhapkho->name = $request->name;
        $nhapkho->email = $request->email;
        if($request->password != null ){
            $nhapkho->password = $request->password;
        }
        $nhapkho->phone_number = $request->phone_number;
        if($request->role_id == null){
            $nhapkho->role_id = Role::CTV; 
        }else{
            $nhapkho->role_id = $request->role_id;
        }
        $nhapkho->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nhapkho = Nhapkho::find($id);

        if (!$nhapkho) {
            return response()->json([
               'message' => 'Không tìm thấy người dùng với ID: '. $id
            ], 404); 
        }

        $nhapkho->Xoa = true;
        $nhapkho->save();

        return response()->json([
           'message' => 'Đã xóa người dùng ID: '. $id
        ], 200);
    }
}
