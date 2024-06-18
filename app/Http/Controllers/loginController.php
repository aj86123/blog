<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\BarrierMiddle;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class loginController extends Controller
{
    public function __construct()
    {
        $this -> middleware('barrier');
    }

    //
    public function show(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');

        $result = Cache::remember($username, 5, function() use ($username) {
            $ret = DB::table('user') 
                    -> select('password') 
                    -> where('username',$username) 
                    -> get() -> toArray();
            if(count($ret) != 1) {
                return null;
            }
            else {
                return $ret[0] -> password;
            }
        });

        $message = $result == $password ? "登陆成功" : "登录失败";
        $ipaddr = $request -> ip();

        // 热日志
        if($result == $password) {  // 登陆成功
            Redis::hdel($username,$ipaddr);
        }                           // 登录失败
        else {
            $fault_cnt = Redis::hexists($username,$ipaddr) ? Redis::hget($username,$ipaddr) : 0;
            Redis::hset($username,$ipaddr,++$fault_cnt);
            Redis::expire($username,$ipaddr,24*60*60);
        }

        // 写日志
        $payload = "username=$username&password=$password";
        DB::table('log') -> insert([
            'url' => "/".$request -> path(),
            'ipaddr' => $ipaddr,
            'payload' => $payload,
            'datetime' => date('Y-m-d H:i:s'),
        ]);

        return view('login/success',['username'=> $username,'password'=> $password,'message' => $message]);
    }
}
