<?php
session_start();
if(empty($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit;
}

$conn = mysqli_connect('localhost', 'root', 'root', 'liaoxi_chicken');
if (!$conn) {
    die("数据库连接失败：" . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8');

$search_name = '';
$min_price = '';
$max_price = '';
$goods_list = [];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $search_name = trim($_POST['search_name']);
    $min_price = trim($_POST['min_price']);
    $max_price = trim($_POST['max_price']);
    
    $sql = "SELECT * FROM `product` WHERE 1=1";
    $params = [];
    $param_types = '';
    
    if(!empty($search_name)){
        $sql .= " AND `pro_name` LIKE ?";
        $params[] = "%{$search_name}%";
        $param_types .= 's';
    }
    if(is_numeric($min_price)){
        $sql .= " AND `price` >= ?";
        $params[] = $min_price;
        $param_types .= 'd';
    }
    if(is_numeric($max_price)){
        $sql .= " AND `price` <= ?";
        $params[] = $max_price;
        $param_types .= 'd';
    }
    $sql .= " ORDER BY `pro_id` DESC";
    
    $stmt = mysqli_prepare($conn, $sql);
    if(!empty($params)){
        mysqli_stmt_bind_param($stmt, $param_types, ...$params);
    }
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    
    while($row = mysqli_fetch_assoc($res)){
        $goods_list[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>商品查询 - 沟帮子烧鸡后台</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Microsoft YaHei", sans-serif;
        }
        .header {
            background: #c9b066;
            color: #fff;
            height: 60px;
            line-height: 60px;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
        }
        .header .title {
            font-size: 20px;
            font-weight: bold;
        }
        .header .back {
            color: #fff;
            text-decoration: none;
            background: rgba(255,255,255,0.2);
            padding: 6px 15px;
            border-radius: 3px;
            line-height: normal;
            margin-top: 12px;
        }
        .container {
            padding: 30px;
            background: #f5f5f5;
            min-height: calc(100vh - 60px);
        }
        .search-form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        .form-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .form-item label {
            font-size: 14px;
            color: #333;
        }
        .form-item input {
            height: 40px;
            padding: 0 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            width: 200px;
        }
        .search-btn {
            background: #c9b066;
            color: #fff;
            border: none;
            height: 40px;
            padding: 0 20px;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 18px;
        }
        .search-btn:hover {
            background: #b89d4a;
        }
        .goods-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .goods-table th, .goods-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        .goods-table th {
            background: #c9b066;
            color: #fff;
        }
        .goods-table tr:hover {
            background: #f9f9f9;
        }
        .goods-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 3px;
        }
        .empty-tip {
            text-align: center;
            padding: 50px;
            color: #999;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">沟帮子烧鸡 - 商品查询</div>
        <a href="admin_index.php" class="back">返回后台首页</a>
    </div>

    <div class="container">
        <form class="search-form" method="post">
            <div class="form-item">
                <label>商品名称</label>
                <input type="text" name="search_name" value="<?php echo htmlspecialchars($search_name); ?>" placeholder="输入烧鸡/猪蹄等关键词">
            </div>
            <div class="form-item">
                <label>最低价格</label>
                <input type="number" name="min_price" value="<?php echo htmlspecialchars($min_price); ?>" placeholder="0" step="0.01">
            </div>
            <div class="form-item">
                <label>最高价格</label>
                <input type="number" name="max_price" value="<?php echo htmlspecialchars($max_price); ?>" placeholder="999" step="0.01">
            </div>
            <button type="submit" class="search-btn">查询商品</button>
        </form>

        <table class="goods-table">
            <thead>
                <tr>
                    <th>商品ID</th>
                    <th>商品名称</th>
                    <th>分类</th>
                    <th>单价</th>
                    <th>库存</th>
                    <th>图片</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($goods_list)): ?>
                    <?php foreach($goods_list as $goods): ?>
                    <tr>
                        <td><?php echo $goods['pro_id']; ?></td>
                        <td><?php echo htmlspecialchars($goods['pro_name']); ?></td>
                        <td>
                            <?php 
                            // 分类名称关联查询
                            $cate_id = $goods['cate_id'];
                            $cate_sql = "SELECT cate_name FROM `category` WHERE cate_id = $cate_id";
                            $cate_res = mysqli_query($conn, $cate_sql);
                            $cate_row = mysqli_fetch_assoc($cate_res);
                            echo $cate_row['cate_name'] ?? '未知分类';
                            ?>
                        </td>
                        <td>¥<?php echo number_format($goods['price'], 2); ?></td>
                        <td><?php echo $goods['stock']; ?></td>
                        <td>
                            <?php if(!empty($goods['pic'])): ?>
                                <img src="<?php echo htmlspecialchars($goods['pic']); ?>" class="goods-img">
                            <?php else: ?>
                                暂无图片
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-tip">暂无符合条件的商品</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>