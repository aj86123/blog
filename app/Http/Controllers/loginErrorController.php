<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\BarrierMiddle;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class loginErrorController extends Controller
{
    public function show(Request $request) {

        $username = $request -> get("username");
        $ipaddr = $request -> ip();
        return view("login/error",["username"=> $username,"ipaddr"=> $ipaddr, "message" => "该设备登录失败次数过多, 24小时内无法登录"]);
    }
}
