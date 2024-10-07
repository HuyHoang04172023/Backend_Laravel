<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Thử đăng nhập
        if (Auth::attempt($request->only('email', 'password'))) {
            // Nếu thành công, chuyển hướng đến dashboard
            return redirect()->intended('/dashboard');
        }

        // Nếu thất bại, quay lại trang login với lỗi
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function logout(Request $request)
{
    Auth::logout();

    // Xóa tất cả session của người dùng
    $request->session()->invalidate();

    // Tạo lại token CSRF để bảo mật
    $request->session()->regenerateToken();

    // Chuyển hướng người dùng về trang login (hoặc trang chủ)
    return redirect('/login');
}

}
