<?php

namespace App\Http\Middleware;

// use App\Http\Requests\DanhMucRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
// use App\Http\Controllers\Admin\DanhMucController;
// use App\Http\Controllers\Admin\SanPhamController;

class CheckRoleAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role->name ?? null;

        if (!in_array($userRole, $roles)) {
            abort(403, 'Ban khong co quyen truy cap trang nay');
        }

        return $next($request);
    }
}
