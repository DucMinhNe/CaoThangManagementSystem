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
    
        // Kiểm tra quyền truy cập dựa trên chức vụ
        if ($request->user() && $request->user()->id_chuc_vu != $chucvu) {
            return redirect()->route('khongcoquyen');
        }
        return $next($request);
    }
}