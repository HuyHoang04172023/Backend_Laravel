<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Kiểm tra nếu người dùng đã đăng nhập và có vai trò khớp
        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

        // Nếu không có quyền, chuyển hướng về trang không có quyền truy cập
        return redirect('/no-access')->with('error', 'Bạn không có quyền truy cập trang này.');
    }
}
