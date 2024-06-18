<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class BarrierMiddle
{

    const barrier_cnt = 3;  // 拦截的错误次数
    public function handle($request, Closure $next)
    {
        $username = $request -> get("username");        
        $ipaddr = $request -> ip();

        $fault_cnt = Redis::hexists($username,$ipaddr) ? Redis::hget($username,$ipaddr) : 0;
        $flag = $fault_cnt >= self::barrier_cnt ? true : false;  // 是否拦截

        if($flag)
        {
            return redirect() -> route("loginerror",["username" => $username]);     // 此处username能通过route传递给控制器，否则loginError无法获得username
        }
        else
        {
            return $next($request);
        }


    }
}