<?php
session_start();
header("Content-type: text/html; charset=utf-8");

// 接收商品数据
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? 0;
$img = $_POST['img'] ?? '';

if(empty($name)){
    echo "error";
    exit;
}

// 初始化购物车数组
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

// 检查商品是否已在购物车中，是则数量+1，否则新增
$found = false;
foreach($_SESSION['cart'] as &$item){
    if($item['name'] == $name){
        $item['num']++;
        $found = true;
        break;
    }
}
if(!$found){
    $_SESSION['cart'][] = [
        'name' => $name,
        'price' => $price,
        'img' => $img,
        'num' => 1
    ];
}

echo "success";
?>