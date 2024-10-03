<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm(){
        return view('auth.login',[
            'title' => 'Đăng nhập'
        ]);
    }

    public function login(Request $request)
    {
        // Validate email và password
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'email.email' => 'Email không hợp lệ'
        ]);
    
        // Lấy thông tin email và password
        $credentials = $request->only('email', 'password');
    
        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->intended('home')->with('success', 'Đăng nhập thành công');
        }
    
        // Đăng nhập thất bại, trả về thông báo lỗi
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ])->withInput($request->only('email'));
    }
    


    public function logout(){
        Auth::logout();
        return redirect()->route('showLoginForm');
    }

}
