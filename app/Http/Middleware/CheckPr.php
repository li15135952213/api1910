<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class CheckPr
{
    /**
     * Handle an incoming request.
     *鉴权中间件
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        echo date('Y-m-d H:i:s');
        $token=$request->input('token');
//        var_dump($token);

        //判断token是否有效
        $uid=Redis::get($token);
        if(!$uid){
            $response = [
                'error' => 50009,
                'msg' => '鉴权失败'
            ];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }
        return $next($request);
    }
}
