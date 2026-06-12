<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('Location: admin_login.php');
    exit;
}

$orders = json_decode(file_get_contents('data/orders.json'), true) ?: [];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>订单管理 - 辽西烧鸡后台</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:"Microsoft YaHei", sans-serif; background:#f5f5f5; }
        .header { background:#2d3748; color:#fff; padding:15px 25px; display:flex; justify-content:space-between; align-items:center; }
        .header h1 { font-size:24px; }
        .header-right { display:flex; align-items:center; gap:20px; }
        .header-right a { color:#fff; text-decoration:none; }
        .sidebar { width:200px; background:#37474f; min-height:calc(100vh - 60px); float:left; padding-top:20px; }
        .sidebar ul { list-style:none; }
        .sidebar li { margin-bottom:5px; }
        .sidebar a { display:block; padding:15px 20px; color:#fff; text-decoration:none; transition:background 0.3s; }
        .sidebar a:hover, .sidebar a.active { background:#e53935; }
        .main { margin-left:200px; padding:25px; }
        .section { background:#fff; border-radius:8px; padding:25px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
        .section-title { font-size:18px; margin-bottom:20px; padding-bottom:10px; border-bottom:1px solid #eee; }
        .table { width:100%; border-collapse:collapse; }
        .table th, .table td { padding:12px; text-align:left; border-bottom:1px solid #eee; }
        .table th { background:#f5f5f5; font-weight:bold; }
        .table tr:hover { background:#f9f9f9; }
        .btn { padding:6px 15px; border:none; border-radius:4px; cursor:pointer; font-size:14px; }
        .btn-ship { background:#42a5f5; color:#fff; }
        .btn-detail { background:#66bb6a; color:#fff; }
        .btn:hover { opacity:0.9; }
        .status-pending { color:#ff9800; }
        .status-shipped { color:#42a5f5; }
        .status-completed { color:#4caf50; }
    </style>
</head>
<body>
    <div class="header">
        <h1>辽西烧鸡后台管理系统</h1>
        <div class="header-right">
            <span>欢迎, <?php echo $_SESSION['admin_name']; ?></span>
            <a href="admin_logout.php">退出登录</a>
        </div>
    </div>
    <div class="sidebar">
        <ul>
            <li><a href="admin_index.php">首页</a></li>
            <li><a href="admin_goods.php">商品管理</a></li>
            <li><a href="admin_member.php">会员管理</a></li>
            <li><a href="admin_order.php" class="active">订单管理</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="section">
            <div class="section-title">订单列表</div>
            <table class="table">
                <tr>
                    <th>订单号</th>
                    <th>用户</th>
                    <th>商品</th>
                    <th>数量</th>
                    <th>总价</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['order_no']; ?></td>
                    <td><?php echo $order['username']; ?></td>
                    <td><?php echo $order['goods_name']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td>¥<?php echo $order['total']; ?></td>
                    <td class="status-<?php echo $order['status']; ?>">
                        <?php 
                            $statusText = ['pending' => '待发货', 'shipped' => '已发货', 'completed' => '已完成'];
                            echo $statusText[$order['status']];
                        ?>
                    </td>
                    <td><?php echo $order['create_time']; ?></td>
                    <td>
                        <button class="btn btn-detail">详情</button>
                        <?php if ($order['status'] == 'pending'): ?>
                        <button class="btn btn-ship">发货</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($orders)): ?>
                <tr><td colspan="8" style="text-align:center;">暂无订单</td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>