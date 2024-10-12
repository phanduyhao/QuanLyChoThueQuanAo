<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $query = User::where('Xoa', null);
    
        // Tìm kiếm theo ID
        if ($request->input('search_id')) {
            $query->where('id', $request->input('search_id'));
        }
    
        // Tìm kiếm theo tên
        if ($request->input('search_name')) {
            $query->where('name', 'LIKE', '%' . $request->input('search_name') . '%');
        }
    
        // Tìm kiếm theo email
        if ($request->input('search_email')) {
            $query->where('email', 'LIKE', '%' . $request->input('search_email') . '%');
        }
    
        // Tìm kiếm theo số điện thoại
        if ($request->input('search_phone')) {
            $query->where('phone_number', 'LIKE', '%' . $request->input('search_phone') . '%');
        }
    
        $users = $query->orderByDesc('id')->paginate(20);
    
        return view('users.index', compact('users', 'roles'), [
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
            'email' => 'unique:users',
            'password' => 'required',
            'phone_number' => 'unique:users',
            
        ],[
            'name.required' => 'Vui lòng nhập tên !',
            'email.unique' => 'Email này đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'phone_number.unique' => 'Số điện thoại này đã tồn tại',

        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->phone_number = $request->phone_number;
        if($request->role_id == null){
            $user->role_id = Role::CTV; 
        }else{
            $user->role_id = $request->role_id;
        }
        $user->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy người dùng với ID: ' . $id
            ], 404); 
        }

        return response()->json($user); 
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
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone_number' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
        ], [
            'name.required' => 'Vui lòng nhập tên!',
            'email.unique' => 'Email này đã tồn tại',
            'phone_number.unique' => 'Số điện thoại này đã tồn tại',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null ){
            $user->password = $request->password;
        }
        $user->phone_number = $request->phone_number;
        if($request->role_id == null){
            $user->role_id = Role::CTV; 
        }else{
            $user->role_id = $request->role_id;
        }
        $user->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
               'message' => 'Không tìm thấy người dùng với ID: '. $id
            ], 404); 
        }

        $user->Xoa = true;
        $user->save();

        return response()->json([
           'message' => 'Đã xóa người dùng ID: '. $id
        ], 200);
    }
}
