<?php
header("Content-type: text/html; charset=utf-8");
// 获取搜索关键词，防止SQL注入（这里只是简单示例，实际项目要更严谨）
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// 模拟商品数据（和你网站的商品一致）
$products = [
    ['name' => '烧鸡', 'img' => 'imges/1.jpg', 'price' => '42.70', 'url' => 'xiangqingye.php'],
    ['name' => '猪蹄', 'img' => 'imges/6.jpg', 'price' => '49.10', 'url' => 'xiangqingye.php'],
    ['name' => '干豆腐', 'img' => 'imges/7.jpg', 'price' => '46.30', 'url' => 'xiangqingye.php'],
    ['name' => '火腿肠', 'img' => 'imges/8.jpg', 'price' => '49.10', 'url' => 'xiangqingye.php'],
];

// 筛选匹配的商品
$searchResults = [];
if (!empty($keyword)) {
    foreach ($products as $p) {
        if (stripos($p['name'], $keyword) !== false) {
            $searchResults[] = $p;
        }
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜索结果 - 辽西烧鸡</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<style>
body { font-family: "Microsoft YaHei", sans-serif; max-width: 1180px; margin: 0 auto; padding: 20px; }
.back-btn { display: inline-block; margin-bottom: 20px; padding: 10px 20px; background: #c9b066; color: #fff; text-decoration: none; border-radius: 4px; }
.back-btn:hover { background: #b89d4a; }
.result-title { font-size: 24px; color: #333; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
.product-list { display: flex; justify-content: space-between; flex-wrap: wrap; }
.product-item { width: 23%; background: #fff; border: 1px solid #eee; margin-bottom: 20px; }
.product-item .img-box { width: 100%; height: 250px; overflow: hidden; }
.product-item .img-box img { width: 100%; height: 100%; object-fit: cover; }
.product-item .info { padding: 15px; text-align: center; }
.product-item .name { font-size: 16px; color: #333; margin-bottom: 10px; }
.product-item .price { font-size: 18px; color: #e63946; margin-bottom: 15px; }
.no-result { font-size: 18px; color: #666; text-align: center; padding: 50px 0; }
</style>
</head>
<body>
    <a href="index.php" class="back-btn">返回首页</a>

    <div class="result-title">
        <?php if (!empty($keyword)): ?>
            搜索关键词：「<?php echo htmlspecialchars($keyword); ?>」，共找到 <?php echo count($searchResults); ?> 个结果
        <?php else: ?>
            请输入商品关键词进行搜索
        <?php endif; ?>
    </div>

    <?php if (!empty($searchResults)): ?>
    <div class="product-list">
        <?php foreach ($searchResults as $product): ?>
        <div class="product-item">
            <a href="<?php echo $product['url']; ?>" style="display:block;text-decoration:none;color:inherit;">
                <div class="img-box">
                    <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>" />
                </div>
                <div class="info">
                    <div class="name"><?php echo $product['name']; ?></div>
                    <div class="price">零售价 ¥<?php echo $product['price']; ?></div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php elseif (!empty($keyword)): ?>
    <div class="no-result">没有找到相关商品，请尝试其他关键词</div>
    <?php endif; ?>
</body>
</html>