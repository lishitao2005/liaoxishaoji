<?php
session_start();
$username = $_SESSION['username'] ?? '';

// 商品数据直接定义在页面中
$goods_data = [
    1 => ['name'=>'干豆腐', 'price'=>46.30, 'stock'=>150, 'sales'=>92, 'image'=>'7.jpg', 'desc'=>'东北干豆腐，薄如蝉翼，口感细腻'],
    2 => ['name'=>'烧鸡', 'price'=>42.70, 'stock'=>100, 'sales'=>121, 'image'=>'1.jpg', 'desc'=>'正宗沟帮子熏鸡，传统工艺制作，风味独特'],
    3 => ['name'=>'猪蹄', 'price'=>49.10, 'stock'=>80, 'sales'=>106, 'image'=>'6.jpg', 'desc'=>'精选猪蹄，卤香浓郁，肉质鲜美'],
    4 => ['name'=>'火腿肠', 'price'=>35.00, 'stock'=>200, 'sales'=>156, 'image'=>'8.jpg', 'desc'=>'优质火腿肠，美味可口'],
    5 => ['name'=>'熏鸡', 'price'=>38.50, 'stock'=>90, 'sales'=>88, 'image'=>'2.jpg', 'desc'=>'传统熏制工艺，香气四溢'],
    6 => ['name'=>'酱牛肉', 'price'=>58.00, 'stock'=>60, 'sales'=>67, 'image'=>'3.jpg', 'desc'=>'秘制酱料，酱香浓郁'],
    7 => ['name'=>'卤鸭', 'price'=>45.80, 'stock'=>70, 'sales'=>75, 'image'=>'4.jpg', 'desc'=>'卤味鸭肉，鲜香可口'],
    8 => ['name'=>'香肠', 'price'=>32.00, 'stock'=>180, 'sales'=>112, 'image'=>'5.jpg', 'desc'=>'手工香肠，风味独特'],
];

$goods_id = isset($_GET['id']) ? intval($_GET['id']) : 1;
if (!isset($goods_data[$goods_id])) {
    $goods_id = 1;
}
$current_goods = $goods_data[$goods_id];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $current_goods['name']; ?> - 辽西烧鸡</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:"Microsoft YaHei", sans-serif; }
        body { background:#f8f9fa; }
        
        .topbar{width:100%;background:#fff;padding:12px 0;border-bottom:1px solid #eee;position:sticky;top:0;z-index:100;}
        .topbar .con{width:1200px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;}
        .topbar .txt{font-size:14px;color:#636e72;}
        .topbar .login-reg a{font-size:14px;color:#2d3436;margin-left:30px;text-decoration:none;}
        .topbar .login-reg a:hover{color:#e53935;}
        .welcome-text{font-size:14px;color:#e53935;margin-left:30px;}
        .back-link{color:#e53935;text-decoration:none;margin-right:20px;font-size:14px;}
        
        .header { background:#fff; height:80px; border-bottom:1px solid #eee; }
        .header .con { width:1200px; margin:0 auto; padding:0 20px; height:100%; display:flex; align-items:center; }
        .logo img { height:60px; }
        
        .main { width:1200px; margin:30px auto; display:flex; gap:40px; }
        .left-col { width:450px; }
        .right-col { flex:1; }
        
        .main-image { width:450px; height:450px; background:#fff; }
        .main-image img { width:100%; height:100%; object-fit:cover; }
        
        .product-title { font-size:24px; color:#2d3436; margin-bottom:15px; font-weight:700; }
        .product-meta { display:flex; gap:15px; margin-bottom:15px; font-size:13px; color:#636e72; }
        
        .price-area { background:#fff5f5; padding:15px; margin-bottom:15px; }
        .current-price { font-size:28px; color:#e53935; font-weight:700; }
        .original-price { font-size:14px; color:#b2bec3; text-decoration:line-through; margin-left:10px; }
        .discount-tag { background:#e53935; color:#fff; padding:3px 8px; font-size:12px; margin-left:10px; }
        
        .delivery-info { display:flex; gap:15px; font-size:13px; color:#636e72; margin-bottom:15px; }
        
        .service-tags { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:20px; }
        .service-tags span { background:#f1f2f6; padding:6px 12px; font-size:12px; color:#636e72; }
        
        .spec-area { margin-bottom:20px; }
        .spec-title { font-size:14px; color:#2d3436; margin-bottom:10px; font-weight:600; }
        .spec-tag { display:inline-block; padding:8px 15px; background:#fff; border:2px solid #e53935; color:#e53935; font-size:13px; }
        
        .quantity-select { display:flex; align-items:center; gap:10px; margin-bottom:20px; }
        .quantity-select button { width:35px; height:35px; border:1px solid #e8e8e8; background:#fff; font-size:18px; cursor:pointer; }
        .quantity-select input { width:50px; height:35px; text-align:center; border:1px solid #e8e8e8; font-size:14px; }
        
        .btn-area { display:flex; gap:15px; }
        .btn-add { flex:1; height:45px; background:#e53935; color:#fff; border:none; font-size:16px; font-weight:600; cursor:pointer; }
        .btn-cart { width:120px; height:45px; background:#f1c40f; color:#333; border:none; font-size:14px; font-weight:600; cursor:pointer; }
        
        .desc-section { width:1200px; margin:30px auto; background:#fff; padding:25px; }
        .section-title { font-size:18px; color:#2d3436; margin-bottom:20px; padding-bottom:10px; border-bottom:2px solid #e8e8e8; font-weight:600; }
        .desc-content { font-size:14px; color:#636e72; line-height:1.8; }
        
        .footer { background:#2d3436; color:#fff; padding:40px 0; margin-top:40px; }
        .footer .con { width:1200px; margin:0 auto; display:flex; justify-content:space-around; }
        .footer h3 { font-size:16px; margin-bottom:15px; }
        .footer ul { list-style:none; }
        .footer li { margin-bottom:8px; }
        .footer li a { color:rgba(255,255,255,0.7); text-decoration:none; font-size:13px; }
    </style>
</head>
<body>
<div class="topbar">
    <div class="con">
        <div class="txt">欢迎您来到辽西烧鸡批发部！</div>
        <div class="login-reg">
            <a href="index.php" class="back-link">← 返回首页</a>
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

<header class="header">
    <div class="con">
        <div class="logo"><a href="index.php"><img src="images/9.jpg" /></a></div>
    </div>
</header>

<div class="main">
    <div class="left-col">
        <div class="main-image">
            <img src="images/<?php echo $current_goods['image']; ?>" alt="<?php echo $current_goods['name']; ?>" />
        </div>
    </div>
    <div class="right-col">
        <h1 class="product-title"><?php echo $current_goods['name']; ?></h1>
        <div class="product-meta">
            <span>已售 <?php echo $current_goods['sales']; ?>+</span>
            <span>可开发票</span>
            <span>库存 <?php echo $current_goods['stock']; ?>件</span>
        </div>
        
        <div class="price-area">
            <span class="current-price">¥<?php echo $current_goods['price']; ?></span>
            <span class="original-price">¥<?php echo round($current_goods['price']*1.15, 2); ?></span>
            <span class="discount-tag">立减15%</span>
        </div>
        
        <div class="delivery-info">
            <span>预计明天发货</span>
            <span>免运费</span>
        </div>
        
        <div class="service-tags">
            <span>坏单包退</span>
            <span>极速退款</span>
            <span>假一赔四</span>
        </div>
        
        <div class="spec-area">
            <div class="spec-title">商品规格</div>
            <div class="spec-tag"><?php echo $current_goods['name']; ?></div>
        </div>
        
        <div class="quantity-select">
            <span>数量</span>
            <button onclick="decrease()">-</button>
            <input type="text" id="quantity" value="1" readonly>
            <button onclick="increase()">+</button>
        </div>
        
        <div class="btn-area">
            <button class="btn-add">立即购买</button>
            <button class="btn-cart">加入购物车</button>
        </div>
    </div>
</div>

<div class="desc-section">
    <div class="section-title">商品详情</div>
    <div class="desc-content">
        <p><?php echo $current_goods['desc']; ?></p>
        <p>&nbsp;</p>
        <p><strong>商品特点：</strong></p>
        <p>1. 精选原料：选用当地优质食材，品质保证</p>
        <p>2. 古法工艺：传承百年的制作技艺，风味独特</p>
        <p>3. 品质保证：严格的质量控制体系</p>
        <p>4. 包装精美：采用环保包装，保鲜卫生</p>
        <p>&nbsp;</p>
        <p><strong>食用建议：</strong></p>
        <p>开袋即食，冷藏口感更佳。加热后风味更浓郁。</p>
    </div>
</div>

<footer class="footer">
    <div class="con">
        <div>
            <h3>购物指南</h3>
            <ul>
                <li><a href="#">购物流程</a></li>
                <li><a href="#">会员介绍</a></li>
            </ul>
        </div>
        <div>
            <h3>配送方式</h3>
            <ul>
                <li><a href="#">配送服务</a></li>
                <li><a href="#">配送费用</a></li>
            </ul>
        </div>
        <div>
            <h3>售后服务</h3>
            <ul>
                <li><a href="#">售后政策</a></li>
                <li><a href="#">退款说明</a></li>
            </ul>
        </div>
        <div>
            <h3>联系方式</h3>
            <ul>
                <li><a href="#">联系客服</a></li>
                <li><a href="#">商家帮助</a></li>
            </ul>
        </div>
    </div>
</footer>

<script>
function increase() {
    var qty = document.getElementById('quantity');
    qty.value = parseInt(qty.value) + 1;
}
function decrease() {
    var qty = document.getElementById('quantity');
    if (parseInt(qty.value) > 1) {
        qty.value = parseInt(qty.value) - 1;
    }
}
</script>
</body>
</html>