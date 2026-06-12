<?php session_start(); $username = $_SESSION['username'] ?? ''; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>辽西烧鸡</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<style>
/* 轮播图样式 */
.hbanner {
    width: 1200px;
    height: 350px;
    margin: 20px auto;
    position: relative;
    overflow: hidden;
}
.slider-wrapper {
    width: 100%;
    height: 100%;
    position: relative;
}
.slides-container {
    width: 100%;
    height: 100%;
    position: relative;
}
.slide {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 0.8s ease;
}
.slide.active {
    opacity: 1;
}
.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.slider-dots {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    z-index: 10;
    list-style: none;
}
.slider-dots li {
    width: 12px;
    height: 12px;
    background: rgba(255,255,255,0.5);
    cursor: pointer;
}
.slider-dots li.active {
    background: #e53935;
}
.slider-arrows {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    display: flex;
    justify-content: space-between;
    z-index: 10;
}
.slider-arrow {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.8);
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    cursor: pointer;
}
.slider-arrow:hover {
    background: #e53935;
    color: #fff;
}
</style>
</head>
<body>
    <div class="topnav">
        <div class="con">
            <div class="txt">欢迎您来到辽西烧鸡批发部！</div>
            <ul class="rightnav">
                <li><a href="index.php" class="m"><span>首页</span></a></li>
                <li><a href="goods-list.php" class="m"><span>产品展示</span></a></li>
                <li><a href="brand-story.php" class="m"><span>品牌故事</span></a></li>
                <li><a href="#" class="m"><span>联系我们</span></a></li>
                <li><?php if($username): ?><a href="logout.php" class="m"><span>退出</span></a><?php else: ?><a href="denglu.php" class="m"><span>登录</span></a><?php endif; ?></li>
                <li><?php if(!$username): ?><a href="zhuce.php" class="m"><span>注册</span></a><?php else: ?><span style="color:#e53935">欢迎, <?php echo $username; ?></span><?php endif; ?></li>
            </ul>
        </div>
    </div>
<header>
    <div class="mainso">
        <div class="logo"><img src="images/9.jpg" /></div>
        <div class="search-area">
            <input type="text" placeholder="请输入商品关键词" class="search-input" />
            <button class="search-btn">搜索</button>
        </div>
        <div class="right-area">
            <div class="cart-wrap">
                <span class="cart-icon"></span>
                <span class="cart-text">我的购物车</span>
                <span class="cart-num">0</span>
            </div>
            <div class="quick-links">
                <a href="goods-list.php?keyword=烧鸡">烧鸡</a>
                <a href="goods-list.php?keyword=猪蹄">猪蹄</a>
                <a href="goods-list.php?keyword=干豆腐">干豆腐</a>
                <a href="goods-list.php?keyword=火腿肠">火腿肠</a>
            </div>
        </div>
    </div>
</header>
<div class="hbanner">
    <div class="slider-wrapper">
        <div class="slides-container">
            <div class="slide active"><img src="images/1.jpg" alt="烧鸡"></div>
            <div class="slide"><img src="images/6.jpg" alt="猪蹄"></div>
            <div class="slide"><img src="images/7.jpg" alt="干豆腐"></div>
            <div class="slide"><img src="images/8.jpg" alt="火腿肠"></div>
        </div>
        
        <div class="slider-arrows">
            <div class="slider-arrow prev" onclick="prevSlide()">‹</div>
            <div class="slider-arrow next" onclick="nextSlide()">›</div>
        </div>
        
        <ul class="slider-dots">
            <li class="active" onclick="goToSlide(0)"></li>
            <li onclick="goToSlide(1)"></li>
            <li onclick="goToSlide(2)"></li>
            <li onclick="goToSlide(3)"></li>
        </ul>
    </div>
</div>
<div class="mslist">
    <div class="porlist w1180">
        <div class="item">
            <a class="pci" href="xiangqingye.php?id=1"><img src="images/7.jpg" /></a>
            <div class="info"> 
                <a href="xiangqingye.php?id=1" class="title">干豆腐</a>
                <div class="price"><em>零售价</em>&nbsp;<span>¥46.30</span></div>
                <a href="xiangqingye.php?id=1" class="pur">立即购买</a>
                <div class="enclosure"><span>已售: 92件</span></div>
            </div>
        </div>
        <div class="item">
            <a class="pci" href="xiangqingye.php?id=2"><img src="images/1.jpg"></a>
            <div class="info">
                <a href="xiangqingye.php?id=2" class="title">烧鸡</a>
                <div class="price"><em>零售价</em>&nbsp;<span>¥42.70</span></div>
                <a href="xiangqingye.php?id=2" class="pur">立即购买</a>
                <div class="enclosure"><span>已售: 121件</span></div>
            </div>               
        </div>
        <div class="item">
            <a class="pci" href="xiangqingye.php?id=3"><img src="images/6.jpg" /></a>
            <div class="info">
                <a href="xiangqingye.php?id=3" class="title">猪蹄</a>
                <div class="price"><em>零售价</em>&nbsp;<span>¥49.10</span></div>
                <a href="xiangqingye.php?id=3" class="pur">立即购买</a>
                <div class="enclosure"><span>已售: 106件</span></div>
            </div>
        </div>
        <div class="item">
            <a class="pci" href="xiangqingye.php?id=4"><img src="images/8.jpg" /></a>
            <div class="info">
                <a href="xiangqingye.php?id=4" class="title">火腿肠</a>
                <div class="price"><em>零售价</em>&nbsp;<span>¥35.00</span></div>
                <a href="xiangqingye.php?id=4" class="pur">立即购买</a>
                <div class="enclosure"><span>已售: 156件</span></div>
            </div>
        </div>
        <div class="item">
            <a class="pci" href="xiangqingye.php?id=5"><img src="images/2.jpg" /></a>
            <div class="info">
                <a href="xiangqingye.php?id=5" class="title">熏鸡</a>
                <div class="price"><em>零售价</em>&nbsp;<span>¥38.50</span></div>
                <a href="xiangqingye.php?id=5" class="pur">立即购买</a>
                <div class="enclosure"><span>已售: 88件</span></div>
            </div>
        </div>
        <div class="item">
            <a class="pci" href="xiangqingye.php?id=6"><img src="images/3.jpg" /></a>
            <div class="info">
                <a href="xiangqingye.php?id=6" class="title">酱牛肉</a>
                <div class="price"><em>零售价</em>&nbsp;<span>¥58.00</span></div>
                <a href="xiangqingye.php?id=6" class="pur">立即购买</a>
                <div class="enclosure"><span>已售: 67件</span></div>
            </div>
        </div>
        <div class="item">
            <a class="pci" href="xiangqingye.php?id=7"><img src="images/4.jpg" /></a>
            <div class="info">
                <a href="xiangqingye.php?id=7" class="title">卤鸭</a>
                <div class="price"><em>零售价</em>&nbsp;<span>¥45.80</span></div>
                <a href="xiangqingye.php?id=7" class="pur">立即购买</a>
                <div class="enclosure"><span>已售: 75件</span></div>
            </div>
        </div>
        <div class="item">
            <a class="pci" href="xiangqingye.php?id=8"><img src="images/5.jpg" /></a>
            <div class="info">
                <a href="xiangqingye.php?id=8" class="title">香肠</a>
                <div class="price"><em>零售价</em>&nbsp;<span>¥32.00</span></div>
                <a href="xiangqingye.php?id=8" class="pur">立即购买</a>
                <div class="enclosure"><span>已售: 112件</span></div>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="innerframe">
        <ul class="fnav"><h2>购物指南</h2><li><a href="">购物流程</a></li><li><a href="">会员介绍</a></li></ul>
        <ul class="fnav"><h2>配送方式</h2><li><a href="">配送服务查询</a></li><li><a href="">配送费收取标准</a></li></ul>
        <ul class="fnav"><h2>支付方式</h2><li><a href="">在线支付</a></li><li><a href="">线下支付</a></li></ul>
        <ul class="fnav"><h2>售后服务</h2><li><a href="">售后政策</a></li><li><a href="">退款说明</a></li></ul>
        <ul class="fnav"><h2>特色服务</h2><li><a href="">零售说明</a></li><li><a href="">无限期换货</a></li></ul>
    </div>
    <div class="innerframe2">
        <div class="tfr"><a href="brand-story.php">关于我们</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">联系客服</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">商家帮助</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">友情链接</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">隐私政策</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">法律声明</a></div>
        <div class="tfr"><span>Copyright (c) 2022 - 2028 辽西烧鸡 版权所有</span>&nbsp;&nbsp;|&nbsp;&nbsp;<span>消费者维权热线: 400 0000 000</span></div>
    </div>
</footer>
<script type="text/javascript">
var currentSlide = 0;
var slides = document.querySelectorAll('.slide');
var dots = document.querySelectorAll('.slider-dots li');
var totalSlides = slides.length;

function showSlide(index) {
    slides.forEach(function(slide, i) {
        slide.classList.remove('active');
    });
    slides[index].classList.add('active');
    
    dots.forEach(function(dot, i) {
        dot.classList.remove('active');
    });
    dots[index].classList.add('active');
    
    currentSlide = index;
}

function nextSlide() {
    var next = (currentSlide + 1) % totalSlides;
    showSlide(next);
}

function prevSlide() {
    var prev = (currentSlide - 1 + totalSlides) % totalSlides;
    showSlide(prev);
}

function goToSlide(index) {
    showSlide(index);
}

var timer = setInterval(nextSlide, 3000);
</script>
</body>
</html>