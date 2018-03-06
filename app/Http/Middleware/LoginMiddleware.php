<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
        $khachhang = Auth::user(); //lấy user đang check ra
        if($khachhang->KichHoat == 1)  //quyen = 1 = admin
          return $next($request);
        else 
          return redirect('dangnhap');
        
      }
      else 
        return redirect('dangnhap');
        //return $next($request);
    }

}
