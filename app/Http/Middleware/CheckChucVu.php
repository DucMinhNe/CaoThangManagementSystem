<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckChucVu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $chucvu)
    {
        $chucvuArray = explode('|', $chucvu);
        $userChucVu = $request->user()->id_chuc_vu;

        // Kiểm tra xem chức vụ của người dùng có trong danh sách chức vụ được cho phép không
        if (!in_array($userChucVu, $chucvuArray)) {
            return redirect()->route('khongcoquyen');
        }
        return $next($request);
    }
}