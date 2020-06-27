<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\TokenModel;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    //用户注册
    public function reg(){
        $user_name= request()->input('user_name');
        $email = request()->input('email');
        $password = request()->input('password');
        $passwords = request()->input('passwords');

        $c = strlen($password);
        if($c<6){
            $response=[
                'error' => 50001,
                'msg' => '密码长度大于6'
            ];
            return $response;
        }

        if ($password != $passwords){
            $response=[
                'error' => 50002,
                'msg' => '请输入正确的密码'
            ];
            return $response;
        }

        $user=UserModel::where(['user_name'=>$user_name])->first();
        if($user){
            $response=[
                'error' => 50003,
                'msg' => '用户已存在'
            ];
            return $response;
        }

        $e = UserModel::where(['email'=>$email])->first();
        if($e){
            $response=[
                'error' => 50004,
                'msg' => 'email已存在'
            ];
            return $response;
        }

        $password=password_hash($password,PASSWORD_BCRYPT);
        $data=[
            'user_name' => $user_name,
            'email' => $email,
            'password' => $password,
            'reg_time' => time()
        ];

        $res=UserModel::insert($data);
//        var_dump($res);
        if($res){
            $response=[
                'error' => 0,
                'msg' => '注册成功'
            ];
        }else{
            $response=[
                'error' => 50005,
                'msg' => '注册失败'
            ];
        }
        return $response;
    }
    //登录
    public function login(Request $request){
        $user_name = $request->input('user_name');
        $password = $request->input('password');
//        echo $user_name;
//        echo $password;
        //验证登录信息
        $user=UserModel::where(['user_name'=>$user_name])->first();
//        var_dump($user_name);
        $res = password_verify($password,$user->password);
        if($res){
           $str = $user->user_id.$user->user_name.time();
//            echo $str;die;
            $token = substr(md5($str),10,16);
//            echo $token;

            //报存token 后续验证使用
//            $data=[
//                'uid' => $user->user_id,
//                'token' =>$token
//            ];

            //将token保存到数据库
//            TokenModel::insert($data);

            //将token保存到Redis中
//            $key = $token;
            Redis::set($token,$user->user_id);

            //设置key的过期时间

            $response=[
                'error' => 0,
                'msg' => 'ok',
                'token' => $token
            ];
        }else{
            $response=[
                'error' => 50006,
                'msg' => '登录失败',
            ];
        }
        return $response;
    }

    //个人中心
    public function center(){
        //判断用户是否登录 判断是否有uid 字段
        $token = $_GET['token'];

//        检查token是否有效
//        $res =TokenModel::where(['token'=>$token])->first();

        $uid=Redis::get($token);
        if($uid){
//            $uid=$res->uid;
            $user_info=UserModel::find($uid);
            //已登录
            echo $user_info->user_name.'欢迎来到个人中心';
        }else{
            //未登录
            echo '请登录';
        }
    }
}
