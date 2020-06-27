<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;

class IndexController extends Controller
{
    //用户注册
    public function reg(){
        return view('user.reg');
    }
    public function regDo(){
//        $post=request()->except('_token');
        //$post['reg_time']=time();
       // $post['password']=password_hash($post['password'], PASSWORD_BCRYPT);
//        $user=UserModel::insert($post);

        $user_name= request()->input('user_name');
        $email = request()->input('email');
        $password = request()->input('password');
        $passwords = request()->input('passwords');
////        echo $user_name;
////        echo $email;
////        echo $password;
////        echo $passwords;
        $c = strlen($password);
        if($c<6){
            die("密码长度大于6");
        }

        if ($password != $passwords){
            die("请输入正确密码");
        }

        $user=UserModel::where(['user_name'=>$user_name])->first();
        if($user){
            die($user_name.'用户已存在');
        }

        $e = UserModel::where(['email'=>$email])->first();
        if($e){
            die('email已存在');
        }

        $password=password_hash($password,PASSWORD_BCRYPT);
        $data=[
            'user_name' => $user_name,
            'email' => $email,
            'password' => $password,
            'reg_time' => time()
        ];
////        $user_model=new UserModel();
////        $user_model->user_name=$user_name;
////        $user_model->email=$email;
////        $user_model->password=$password;
////        $user_model->reg_time=time();
////        $res=$user_model->save();
        $res=UserModel::insert($data);
        var_dump($res);
        if($res){
            return redirect('/user/login');
        }else{
            echo '注册失败';
        }
    }
    //用户登录
    public function login(){
        return view('user.login');
    }
    public function loginDo(Request $request){
        $user_name = $request->input('user_name');
        $password = $request->input('password');
//        echo $user_name;
//        echo $password;
        //验证登录信息
        $user=UserModel::where(['user_name'=>$user_name])->first();
//        var_dump($user_name);
        $res=password_verify($password,$user->password);
        if($res){
            header('Refresh:2;url=/user/center');
            echo "登录成功";
        }else{
            header('Refresh:2;url=/user/login');
            echo "登录失败";
        }
    }

    //用户中心
    public function center(){
        return view('user.center');
    }
}
