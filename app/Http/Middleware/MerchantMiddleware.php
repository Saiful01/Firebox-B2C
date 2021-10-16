<?php

namespace App\Http\Middleware;

use App\Shop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use MongoDB\Driver\Session;

class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return Redirect::to('/admin/login');
        }
        else
            if(Auth::user()->user_type=2){
                $active=  Shop::where('shop_id', \Illuminate\Support\Facades\Session::get('shop_id'))->first();
                if ($active->is_active== false)
                    return Redirect::to('/admin/login');
            }



      /*  if(Auth::user()->user_type=2){

        }*/
        return $next($request);
    }
}
