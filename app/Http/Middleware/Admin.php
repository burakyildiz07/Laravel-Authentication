<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Admin
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
        /*
         * Admin paneline girişte yapılacak kontroller.
         * Kullanıcının giriş yaptığını(Auth::check) ve
         * Admin yetkinisine(Auth::user()->isadmin()) sahip olup olmadığını kontrol ettiriyoruz.
         */

        if (Auth::check() && Auth::user()->hasRole('admin')){
            return $next($request);
        }else if (Auth::check() && Auth::user()->hasRole('admin')){
             return $next($request);
         }
        /*
         * Kullanıcı giriş yapmadıysa ve admin yetkisine sahip değilse anasayfa hata mesajı göndererek
         * yönlendiriyoruz.
         */
        return Redirect::to('/')->withErrors(['msg'=>'Bu alana girmeye yetkiniz bulunmamaktadır.']);
    }
}
