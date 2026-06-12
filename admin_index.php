<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('Location: admin_login.php');
    exit;
}

$users = json_decode(file_get_contents('data/users.json'), true) ?: [];
$goods = json_decode(file_get_contents('data/goods.json'), true) ?: [];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理首页 - 辽西烧鸡</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Microsoft YaHei", sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: 700;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        
        .header-right span {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .header-right a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            padding: 8px 20px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .header-right a:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .container {
            display: flex;
            min-height: calc(100vh - 80px);
        }
        
        .sidebar {
            width: 220px;
            background: #fff;
            padding: 30px 0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
        }
        
        .sidebar ul {
            list-style: none;
        }
        
        .sidebar li {
            margin-bottom: 5px;
        }
        
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 15px 30px;
            color: #2d3436;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar a:hover,
        .sidebar a.active {
            background: linear-gradient(90deg, rgba(229, 57, 53, 0.1) 0%, transparent 100%);
            color: #e53935;
            border-left-color: #e53935;
        }
        
        .sidebar .icon {
            margin-right: 12px;
            font-size: 18px;
        }
        
        .main {
            flex: 1;
            padding: 30px 40px;
        }
        
        .welcome-section {
            background: linear-gradient(135deg, #e53935 0%, #ff6f60 100%);
            color: #fff;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(229, 57, 53, 0.3);
        }
        
        .welcome-section h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .welcome-section p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .dashboard {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .card {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--card-color);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }
        
        .card h3 {
            font-size: 14px;
            color: #636e72;
            margin-bottom: 15px;
            font-weight: 500;
        }
        
        .card .num {
            font-size: 36px;
            font-weight: 700;
            color: var(--card-color);
            margin-bottom: 5px;
        }
        
        .card .desc {
            font-size: 13px;
            color: #b2bec3;
        }
        
        .card-icon {
            position: absolute;
            top: 25px;
            right: 25px;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            background: var(--card-color);
            opacity: 0.1;
        }
        
        .section {
            background: #fff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }
        
        .section-title {
            font-size: 18px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f2f6;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .section-title a {
            font-size: 13px;
            color: #e53935;
            text-decoration: none;
            font-weight: 500;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th {
            text-align: left;
            padding: 15px;
            background: #f8f9fa;
            font-weight: 600;
            color: #2d3436;
            font-size: 14px;
            border-radius: 8px 8px 0 0;
        }
        
        .table td {
            padding: 15px;
            border-bottom: 1px solid #f1f2f6;
            font-size: 14px;
            color: #2d3436;
        }
        
        .table tr:hover {
            background: #f8f9fa;
        }
        
        .table tr:last-child td {
            border-bottom: none;
        }
        
        .status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-normal {
            background: #e8f5e9;
            color: #2e7d32;
        }
        
        .status-banned {
            background: #ffebee;
            color: #c62828;
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e53935 0%, #ff6f60 100%);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📦 辽西烧鸡后台管理系统</h1>
        <div class="header-right">
            <span>欢迎, <?php echo $_SESSION['admin_name']; ?></span>
            <a href="admin_logout.php">退出登录</a>
        </div>
    </div>
    
    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="admin_index.php" class="active"><span class="icon">📊</span>首页</a></li>
                <li><a href="admin_goods.php"><span class="icon">📦</span>商品管理</a></li>
                <li><a href="admin_member.php"><span class="icon">👥</span>会员管理</a></li>
                <li><a href="admin_order.php"><span class="icon">🛒</span>订单管理</a></li>
            </ul>
        </div>
        
        <div class="main">
            <div class="welcome-section">
                <h2>🎉 欢迎回来，管理员！</h2>
                <p>今天是个好日子，让我们来看看店铺的运营情况吧</p>
            </div>
            
            <div class="dashboard">
                <div class="card" style="--card-color: #e53935;">
                    <h3>商品总数</h3>
                    <div class="num"><?php echo count($goods); ?></div>
                    <div class="desc">件商品在售</div>
                    <div class="card-icon">📦</div>
                </div>
                <div class="card" style="--card-color: #3498db;">
                    <h3>会员总数</h3>
                    <div class="num"><?php echo count($users); ?></div>
                    <div class="desc">位注册会员</div>
                    <div class="card-icon">👥</div>
                </div>
                <div class="card" style="--card-color: #2ecc71;">
                    <h3>今日订单</h3>
                    <div class="num">0</div>
                    <div class="desc">笔新订单</div>
                    <div class="card-icon">🛒</div>
                </div>
                <div class="card" style="--card-color: #f39c12;">
                    <h3>今日销售额</h3>
                    <div class="num">¥0</div>
                    <div class="desc">元</div>
                    <div class="card-icon">💰</div>
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">
                    <span>📋 最近注册用户</span>
                    <a href="admin_member.php">查看全部 →</a>
                </div>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>手机号</th>
                        <th>注册时间</th>
                        <th>状态</th>
                    </tr>
                    <?php foreach (array_slice(array_reverse($users), 0, 5) as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['phone'] ?: '-'; ?></td>
                        <td><?php echo $user['reg_time']; ?></td>
                        <td>
                            <span class="status <?php echo $user['status'] ? 'status-normal' : 'status-banned'; ?>">
                                <?php echo $user['status'] ? '正常' : '禁用'; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($users)): ?>
                    <tr><td colspan="5" style="text-align:center;color:#b2bec3;">暂无用户数据</td></tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>