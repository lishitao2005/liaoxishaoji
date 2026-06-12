<?php
session_start();
$username = $_SESSION['username'] ?? '';
$cart = $_SESSION['cart'] ?? [];
$total_price = 0;

// 处理数量修改/删除请求
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        $index = $_POST['index'] ?? 0;
        if($action == 'del'){
            // 删除商品
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // 重建索引
        }elseif($action == 'update'){
            // 修改数量
            $num = intval($_POST['num']);
            if($num >= 1 && $num <= 99){
                $_SESSION['cart'][$index]['num'] = $num;
            }
        }
        header("Location: cart.php");
        exit;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的购物车 - 辽西烧鸡</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<style>
/* 全局样式和首页保持一致 */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Microsoft YaHei", sans-serif;
}
ul, li { list-style: none; }
a { text-decoration: none; color: inherit; }
img { border: none; max-width: 100%; }

/* 顶部欢迎条 */
.topbar {
    width: 100%;
    background: #fff;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}
.topbar .con {
    width: 1180px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.topbar .txt {
    font-size: 14px;
    color: #333;
}
.topbar .login-reg a {
    font-size: 16px;
    color: #333;
    margin-left: 30px;
}
.topbar .login-reg a:hover {
    color: #c9b066;
}
.topbar .welcome-text {
    font-size: 16px;
    color: #c9b066;
    margin-left: 30px;
}

/* 头部 */
header {
    width: 100%;
    background: #fff;
    padding: 20px 0;
    position: relative;
    z-index: 10;
}
header .mainso {
    width: 1180px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 80px;
}
header .logo {
    display: flex;
    align-items: center;
}
header .logo img {
    height: 80px;
    margin-right: 15px;
    display: block;
}
header .logo .logo-text {
    font-size: 30px;
    color: #c9b066;
    font-weight: bold;
}
header .right-area {
    display: flex;
    align-items: center;
}
header .cart-wrap {
    display: flex;
    align-items: center;
    background: #c9b066;
    color: #fff;
    padding: 0 30px;
    height: 54px;
    border-radius: 25px;
    cursor: pointer;
}
header .cart-wrap .cart-icon {
    width: 30px;
    height: 30px;
    background: url('imges/cart-icon.png') no-repeat center center;
    background-size: contain;
    margin-right: 10px;
}
header .cart-wrap .cart-text {
    font-size: 20px;
    margin-right: 10px;
}
header .cart-wrap .cart-num {
    background: #fff;
    color: #c9b066;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    text-align: center;
    line-height: 22px;
    font-size: 14px;
}

/* 主导航栏 */
nav {
    width: 100%;
    background: #c9b066;
}
nav .nav-con {
    width: 1180px;
    margin: 0 auto;
    display: flex;
    justify-content: flex-start;
}
nav a {
    display: block;
    padding: 18px 30px;
    color: #fff;
    font-size: 20px;
    transition: background 0.3s;
}
nav a:hover {
    background: #b89d4a;
}

/* 购物车主体 */
.cart-container {
    width: 1180px;
    margin: 30px auto;
    background: #fff;
    border: 1px solid #eee;
    padding: 20px;
}
.cart-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    padding-left: 10px;
    border-left: 4px solid #c9b066;
}
.cart-table {
    width: 100%;
    border-collapse: collapse;
}
.cart-table th {
    background: #f5f5f5;
    padding: 15px;
    font-size: 16px;
    color: #333;
    text-align: center;
    border-bottom: 1px solid #eee;
}
.cart-table td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}
.cart-table .product-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border: 1px solid #eee;
}
.cart-table .product-name {
    font-size: 16px;
    color: #333;
}
.cart-table .product-price {
    font-size: 16px;
    color: #e63946;
}
.cart-table .num-input {
    width: 60px;
    height: 30px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 16px;
}
.cart-table .del-btn {
    color: #e63946;
    cursor: pointer;
    font-size: 14px;
}
.cart-table .del-btn:hover {
    text-decoration: underline;
}
.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    border-top: 1px solid #eee;
    margin-top: 20px;
}
.cart-footer .total {
    font-size: 20px;
    color: #333;
}
.cart-footer .total-price {
    color: #e63946;
    font-weight: bold;
    font-size: 24px;
}
.cart-footer .btn-group {
    display: flex;
    gap: 15px;
}
.cart-footer .btn {
    padding: 12px 30px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s;
}
.cart-footer .btn-back {
    background: #fff;
    border: 2px solid #c9b066;
    color: #333;
}
.cart-footer .btn-back:hover {
    background: #c9b066;
    color: #fff;
}
.cart-footer .btn-checkout {
    background: #c9b066;
    color: #fff;
}
.cart-footer .btn-checkout:hover {
    background: #b89d4a;
}
.empty-cart {
    text-align: center;
    padding: 50px 0;
    font-size: 18px;
    color: #666;
}
</style>
</head>
<body>
    <!-- 顶部欢迎条 -->
    <div class="topbar">
        <div class="con">
            <div class="txt">欢迎您来到辽西烧鸡批发部！</div>
            <div class="login-reg">
                <?php if (!empty($username)): ?>
                    <span class="welcome-text">欢迎，<?php echo htmlspecialchars($username); ?></span>
                    <a href="logout.php">退出登录</a>
                <?php else: ?>
                    <a href="denglu.php">登录</a>
                    <a href="zhuce.php">注册</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 头部 -->
    <header>
        <div class="mainso">
            <div class="logo">
                <img src="imges/9.jpg" alt="辽西烧鸡Logo" />
                <div class="logo-text">辽西烧鸡</div>
            </div>
            <div class="right-area">
                <a href="cart.php" class="cart-wrap" style="text-decoration:none;">
                    <span class="cart-icon"></span>
                    <span class="cart-text">我的购物车</span>
                    <span class="cart-num"><?php echo count($cart); ?></span>
                </a>
            </div>
        </div>
    </header>

    <!-- 导航栏 -->
    <nav>
        <div class="nav-con">
            <a href="index.php">首页</a>
            <a href="erjiye1.php">烧鸡</a>
            <a href="erjiye2.php">猪蹄</a>
            <a href="erjiye3.php">干豆腐</a>
            <a href="erjiye4.php">火腿肠</a>
        </div>
    </nav>

    <!-- 购物车主体 -->
    <div class="cart-container">
        <div class="cart-title">我的购物车</div>
        <?php if(empty($cart)): ?>
            <div class="empty-cart">
                您的购物车还是空的，快去挑选心仪的商品吧！<br>
                <a href="index.php" style="color:#c9b066; text-decoration:underline;">去首页逛逛</a>
            </div>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>商品图片</th>
                        <th>商品名称</th>
                        <th>单价</th>
                        <th>数量</th>
                        <th>小计</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cart as $index => $item): ?>
                        <?php 
                            $subtotal = $item['price'] * $item['num'];
                            $total_price += $subtotal;
                        ?>
                        <tr>
                            <td><img src="<?php echo $item['img']; ?>" class="product-img" alt="<?php echo $item['name']; ?>"></td>
                            <td class="product-name"><?php echo $item['name']; ?></td>
                            <td class="product-price">¥<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                    <input type="number" name="num" class="num-input" value="<?php echo $item['num']; ?>" min="1" max="99" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="product-price">¥<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="action" value="del">
                                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                                    <button type="submit" class="del-btn" onclick="return confirm('确定要删除该商品吗？')">删除</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-footer">
                <div class="total">
                    商品总计：<span class="total-price">¥<?php echo number_format($total_price, 2); ?></span>
                </div>
                <div class="btn-group">
                    <a href="index.php" class="btn btn-back">继续购物</a>
                    <button class="btn btn-checkout" onclick="alert('订单提交成功！（演示用）')">立即结算</button>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- 页脚 -->
    <footer>
        <div class="innerframe">
            <ul class="fnav">
                <h2>购物指南</h2>
                <li><a href="1.php">购物流程</a></li>
                <li><a href="1.php">会员介绍</a></li>
            </ul>
            <ul class="fnav">
                <h2>配送方式</h2>
                <li><a href="2.php">配送服务查询</a></li>
                <li><a href="2.php">配送费收取标准</a></li>
            </ul>
            <ul class="fnav">
                <h2>支付方式</h2>
                <li><a href="3.php">在线支付</a></li>
                <li><a href="3.php">线下支付</a></li>
            </ul>
            <ul class="fnav">
                <h2>售后服务</h2>
                <li><a href="4.php">售后政策</a></li>
                <li><a href="4.php">退款说明</a></li>
            </ul>
            <ul class="fnav">
                <h2>特色服务</h2>
                <li><a href="5.php">零售说明</a></li>
                <li><a href="5.php">退换货政策</a></li>
            </ul>
        </div>
        <div class="innerframe2" style="width:1180px; margin:0 auto; text-align:center; padding-top:20px; border-top:1px solid #ddd;">
            <div class="tfr">
                <a href="6.php">关于我们</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="7.php">联系客服</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="8.php">商家帮助</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="9.php">友情链接</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="10.php">隐私政策</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="11.php">法律声明</a>
            </div>
            <div class="tfr">
                <span>Copyright (c) 2022 - 2028 辽西烧鸡 版权所有</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                <span>消费者维权热线: 400 0000 000</span>
            </div>
        </div>
    </footer>
</body>
</html>