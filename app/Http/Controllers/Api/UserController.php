<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;

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
}
