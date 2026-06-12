<?php
session_start();
$username = $_SESSION['username'] ?? '';

$goods = json_decode(file_get_contents('data/goods.json'), true) ?: [];

$keyword = $_GET['keyword'] ?? '';
if ($keyword) {
    $goods = array_filter($goods, function($item) use ($keyword) {
        return strpos($item['name'], $keyword) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>产品展示 - 辽西烧鸡</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:"Microsoft YaHei", sans-serif; }
        body { background:#f8f9fa; }
        
        .topbar{width:100%;background:#fff;border-bottom:1px solid #eee;height:50px;line-height:50px;position:sticky;top:0;z-index:1000;}
        .topbar .con{width:1200px;margin:0 auto;padding:0 20px;display:flex;justify-content:space-between;align-items:center;}
        .topbar .rightnav{display:flex;gap:35px;list-style:none;}
        .topbar .rightnav li a{font-size:14px;color:#2d3436;text-decoration:none;}
        .topbar .rightnav li a:hover{color:#e53935;}
        
        .header { background:#fff; height:100px; }
        .header .con { width:1200px; margin:0 auto; padding:0 20px; height:100%; display:flex; align-items:center; }
        .logo img { height:70px; }
        
        .search-area { position:absolute; left:50%; transform:translateX(-50%); width:550px; display:flex; }
        .search-input { flex:1; height:48px; padding:0 20px; border:2px solid #e8e8e8; border-right:none; font-size:15px; }
        .search-btn { width:120px; height:48px; background:linear-gradient(135deg,#e53935,#ff6f60); color:#fff; border:none; font-size:16px; cursor:pointer; }
        
        .main { width:1200px; margin:30px auto; }
        .page-title { font-size:24px; color:#2d3436; margin-bottom:20px; }
        
        .filter-bar { display:flex; gap:20px; margin-bottom:20px; padding:15px; background:#fff; }
        .filter-bar a { font-size:14px; color:#636e72; text-decoration:none; padding:8px 15px; }
        .filter-bar a.active { background:#e53935; color:#fff; }
        
        .goods-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:30px; }
        
        .item { background:#fff; padding:20px; border:1px solid #eee; }
        .item:hover { box-shadow:0 8px 25px rgba(0,0,0,0.1); }
        
        .pci { width:100%; height:220px; overflow:hidden; margin-bottom:15px; }
        .pci img { width:100%; height:100%; object-fit:cover; }
        
        .title { font-size:16px; color:#2d3436; margin-bottom:12px; text-decoration:none; display:block; }
        .title:hover { color:#e53935; }
        
        .price { font-size:22px; color:#e53935; font-weight:700; margin-bottom:15px; }
        
        .pur { display:block; width:100%; height:40px; line-height:40px; background:linear-gradient(135deg,#e53935,#ff6f60); color:#fff; text-align:center; text-decoration:none; font-size:14px; font-weight:600; }
        
        .footer { background:#2d3436; color:#fff; padding:50px 0; margin-top:50px; }
        .footer .con { width:1200px; margin:0 auto; display:flex; justify-content:space-around; }
        .footer h3 { margin-bottom:20px; }
        .footer ul { list-style:none; }
        .footer li { margin-bottom:10px; }
        .footer li a { color:rgba(255,255,255,0.7); text-decoration:none; }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="con">
            <div>欢迎来到辽西烧鸡批发部！</div>
            <ul class="rightnav">
                <li><a href="index.php">首页</a></li>
                <li><a href="goods-list.php">产品展示</a></li>
                <li><a href="brand-story.php">品牌故事</a></li>
                <li><a href="denglu.php">登录</a></li>
                <li><a href="zhuce.php">注册</a></li>
            </ul>
        </div>
    </div>
    
    <header class="header">
        <div class="con">
            <div class="logo"><img src="images/9.jpg" /></div>
            <div class="search-area">
                <input type="text" class="search-input" placeholder="搜索商品" />
                <button class="search-btn">搜索</button>
            </div>
        </div>
    </header>
    
    <div class="main">
        <h1 class="page-title">产品展示</h1>
        
        <div class="filter-bar">
            <a href="goods-list.php" class="<?php echo !$keyword ? 'active' : ''; ?>">全部</a>
            <a href="goods-list.php?keyword=烧鸡" class="<?php echo $keyword == '烧鸡' ? 'active' : ''; ?>">烧鸡</a>
            <a href="goods-list.php?keyword=猪蹄" class="<?php echo $keyword == '猪蹄' ? 'active' : ''; ?>">猪蹄</a>
            <a href="goods-list.php?keyword=牛肉" class="<?php echo $keyword == '牛肉' ? 'active' : ''; ?>">牛肉</a>
            <a href="goods-list.php?keyword=香肠" class="<?php echo $keyword == '香肠' ? 'active' : ''; ?>">香肠</a>
        </div>
        
        <div class="goods-grid">
            <?php foreach ($goods as $item): ?>
            <div class="item">
                <a href="xiangqingye.php?id=<?php echo $item['id']; ?>" class="pci"><img src="images/<?php echo $item['image']; ?>" /></a>
                <a href="xiangqingye.php?id=<?php echo $item['id']; ?>" class="title"><?php echo $item['name']; ?></a>
                <div class="price">¥<?php echo $item['price']; ?></div>
                <a href="xiangqingye.php?id=<?php echo $item['id']; ?>" class="pur">查看详情</a>
            </div>
            <?php endforeach; ?>
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
</body>
</html>