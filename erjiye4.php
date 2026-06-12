<?php
session_start();
$username = $_SESSION['username'] ?? '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>沟帮子火腿肠 - 辽西烧鸡批发部</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<style>
/* 全局样式 与首页完全一致 */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Microsoft YaHei", sans-serif;
}
ul, li { list-style: none; }
a { text-decoration: none; color: inherit; }
img { border: none; max-width: 100%; }

/* 顶部登录条 */
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
.welcome-text {
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
}
header .logo .logo-text {
    font-size: 30px;
    color: #c9b066;
    font-weight: bold;
}
header .search-area {
    display: flex;
    align-items: center;
    flex: 1;
    margin: 0 40px;
}
header .search-input {
    width: 100%;
    height: 50px;
    border: 2px solid #c9b066;
    border-radius: 25px 0 0 25px;
    padding: 0 20px;
    font-size: 16px;
    outline: none;
}
header .search-btn {
    height: 54px;
    padding: 0 40px;
    background: #c9b066;
    color: #fff;
    border: none;
    border-radius: 0 25px 25px 0;
    font-size: 20px;
    cursor: pointer;
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
    background: url('imges/cart-icon.png') no-repeat center;
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

/* 导航栏（完全不改动格式） */
nav {
    width: 100%;
    background: #c9b066;
}
nav .nav-con {
    width: 1180px;
    margin: 0 auto;
    display: flex;
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

/* 火腿肠专区样式 */
.ham-section {
    width: 1180px;
    margin: 40px auto;
}
.section-title {
    font-size: 28px;
    color: #c9b066;
    text-align: center;
    margin-bottom: 10px;
}
.section-desc {
    text-align: center;
    color: #666;
    margin-bottom: 40px;
    font-size: 16px;
}

/* 商品列表 */
.product-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
.product-item {
    width: 23%;
    border: 1px solid #eee;
    margin-bottom: 30px;
    background: #fff;
}
.product-item .img-box {
    width: 100%;
    height: 260px;
    overflow: hidden;
}
.product-item .img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.product-item .info {
    padding: 15px;
    text-align: center;
}
.product-item .name {
    font-size: 17px;
    color: #333;
    margin-bottom: 8px;
}
.product-item .price {
    font-size: 19px;
    color: #e63946;
    margin-bottom: 12px;
    font-weight: bold;
}
.product-item .btn {
    display: inline-block;
    padding: 8px 22px;
    background: #c9b066;
    color: #fff;
    border-radius: 25px;
    font-size: 14px;
}

/* 页脚 */
footer {
    width: 100%;
    background: #f5f5f;
    padding: 40px 0;
    margin-top: 40px;
}
footer .innerframe {
    width: 1180px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
}
footer .fnav {
    width: 18%;
}
footer .fnav h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
}
footer .fnav li {
    font-size: 16px;
    color: #666;
    margin-bottom: 10px;
}
footer .innerframe2 {
    width: 1180px;
    margin: 0 auto;
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #ddd;
    margin-top: 30px;
}
footer .tfr {
    font-size: 16px;
    color: #666;
    margin-bottom: 10px;
}
</style>
</head>

<body>

<!-- 顶部登录条 -->
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
            <img src="images/9.jpg" alt="Logo" />
            <div class="logo-text">辽西烧鸡</div>
        </div>
        <div class="search-area">
            <input type="text" placeholder="搜索沟帮子火腿肠" class="search-input" />
            <button class="search-btn">搜索</button>
        </div>
        <div class="right-area">
            <div class="cart-wrap">
                <span class="cart-icon"></span>
                <span class="cart-text">我的购物车</span>
                <span class="cart-num">0</span>
            </div>
        </div>
    </div>
</header>

<!-- 导航栏（五个菜单同一行） -->
<nav>
    <div class="nav-con">
        <a href="index.php">首页</a>
        <a href="erjiye1.php">烧鸡</a>
        <a href="erjiye2.php">猪蹄</a>
        <a href="erjiye3.php">干豆腐</a>
        <a href="erjiye4.php">火腿肠</a>
    </div>
</nav>

<!-- 沟帮子火腿肠专区 -->
<div class="ham-section">
    <div class="section-title">沟帮子火腿肠系列</div>
    <div class="section-desc">精选瘦肉 · 筋道弹牙 · 真空包装 · 开袋即食</div>

    <div class="product-list">
        <!-- 火腿肠1 -->
        <div class="product-item">
            <a href="xiangqingye.php">
                <div class="img-box">
                    <img src="images/8.jpg" alt="沟帮子火腿肠" />
                </div>
                <div class="info">
                    <div class="name">沟帮子火腿肠 300g</div>
                    <div class="price">¥16.90</div>
                    <div class="btn">立即购买</div>
                </div>
            </a>
        </div>

        <!-- 火腿肠2 -->
        <div class="product-item">
            <a href="xiangqingye.php">
                <div class="img-box">
                    <img src="images/8.jpg" alt="沟帮子火腿肠" />
                </div>
                <div class="info">
                    <div class="name">沟帮子瘦肉肠 400g</div>
                    <div class="price">¥22.90</div>
                    <div class="btn">立即购买</div>
                </div>
            </a>
        </div>

        <!-- 火腿肠3 -->
        <div class="product-item">
            <a href="xiangqingye.php">
                <div class="img-box">
                    <img src="images/8.jpg" alt="沟帮子火腿肠" />
                </div>
                <div class="info">
                    <div class="name">沟帮子风味烤肠</div>
                    <div class="price">¥26.90</div>
                    <div class="btn">立即购买</div>
                </div>
            </a>
        </div>

        <!-- 火腿肠4 -->
        <div class="product-item">
            <a href="xiangqingye.php">
                <div class="img-box">
                    <img src="images/8.jpg" alt="沟帮子火腿肠" />
                </div>
                <div class="info">
                    <div class="name">火腿肠礼盒装</div>
                    <div class="price">¥59.90</div>
                    <div class="btn">立即购买</div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- 页脚 -->
<footer>
    <div class="innerframe">
        <ul class="fnav"><h2>购物指南</h2><li>购物流程</li><li>会员介绍</li></ul>
        <ul class="fnav"><h2>配送方式</h2><li>配送查询</li><li>运费标准</li></ul>
        <ul class="fnav"><h2>支付方式</h2><li>在线支付</li><li>线下支付</li></ul>
        <ul class="fnav"><h2>售后服务</h2><li>售后政策</li><li>退款说明</li></ul>
        <ul class="fnav"><h2>特色服务</h2><li>零售说明</li><li>退换货政策</li></ul>
    </div>
    <div class="innerframe2">
        <div class="tfr">Copyright © 2025 辽西烧鸡 版权所有</div>
    </div>
</footer>

</body>
</html>