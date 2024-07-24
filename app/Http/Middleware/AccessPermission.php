<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* if(Auth::user()->hasRole('admin')){ //hasRole tên bên model
            return $next($request);         // nếu có quyền admin thì đc vô không thì bín
        }
        return redirect()->back(); */

        if(Auth::user()->hasRole('admin')){ //hasRole tên bên model
            return $next($request);         // nếu có quyền admin thì đc vô không thì bín
        }elseif(Auth::user()->hasAnyRole(['admin','Nhân viên bán hàng'])){   //hasRole tên bên model
            return $next($request);                                     // nếu có quyền admin và quyền bán hàng thì đc vô không thì bín
        }else{
            return redirect()->back()->with('message','Bạn không có quyền truy cập');
        }
    }
}
