<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
//    商品详情页
    public function detail(){
        $goods_id = $_GET['id'];
//        echo 'goods_id:'.$goods_id;echo'<br>';
        echo $goods_id;
    }
}
