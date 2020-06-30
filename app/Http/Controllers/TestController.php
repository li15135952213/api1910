<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function hello(){
        echo __METHOD__;echo '<br>';
        echo date('Y-m-d H:i:s');
    }
    //签名的调试
    public function sign1(){
        $key = '1910';
        $data='hello world';
        $sign=sha1($data.$key);
        echo $data;
        echo $sign;

        $b_url = 'http://www.1910.com/secret?data='.$data.'&sign='.$sign;
        echo $b_url;
    }
    //接受数据
    public function secret(){
        $key = '1910';
        echo '<pre>';print_r($_GET);echo'<pre>';
        //接受数据验证签名
        $data = $_GET['data'];   //接受数据
        $sign = $_GET['sign'];  //接受签名

        $local_sign=sha1($data.$key);
        echo $local_sign;
        if($sign==$local_sign){
            echo '验签通过';
        }else{
            echo '验签失败';
        }
    }
    public function www(){
//        echo __METHOD__;
        $key = '1910';
        $url='http://api.1910.com/api/info';
//        echo "http://api.1910.com/api/info";

        //向api发送数据
        //get方式
        $data = 'hello';
        $sign = sha1($data.$key);
        $url = $url . '?data='.$data.'&sign='.$sign;
//        echo $url;die;
        //PHP发起网络请求
        $response=file_get_contents($url);
//        var_dump($response);die;
        echo $response;

    }
}
