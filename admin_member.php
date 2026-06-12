<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('Location: admin_login.php');
    exit;
}

$users = json_decode(file_get_contents('data/users.json'), true) ?: [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ban'])) {
        $id = intval($_POST['id']);
        foreach ($users as &$user) {
            if ($user['id'] == $id) {
                $user['status'] = 0;
                break;
            }
        }
        file_put_contents('data/users.json', json_encode($users));
        header('Location: admin_member.php');
        exit;
    } elseif (isset($_POST['unban'])) {
        $id = intval($_POST['id']);
        foreach ($users as &$user) {
            if ($user['id'] == $id) {
                $user['status'] = 1;
                break;
            }
        }
        file_put_contents('data/users.json', json_encode($users));
        header('Location: admin_member.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会员管理 - 辽西烧鸡后台</title>
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
        .btn-ban { background:#ef5350; color:#fff; }
        .btn-unban { background:#4caf50; color:#fff; }
        .btn:hover { opacity:0.9; }
        .search-bar { margin-bottom:20px; display:flex; gap:15px; }
        .search-bar input { flex:1; padding:10px; border:1px solid #ddd; border-radius:4px; }
        .status-normal { color:#4caf50; font-weight:bold; }
        .status-banned { color:#ef5350; font-weight:bold; }
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
            <li><a href="admin_member.php" class="active">会员管理</a></li>
            <li><a href="admin_order.php">订单管理</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="section">
            <div class="section-title">会员列表</div>
            <div class="search-bar">
                <input type="text" placeholder="搜索用户名" id="searchInput">
                <button class="btn btn-unban" onclick="searchUser()">搜索</button>
            </div>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>用户名</th>
                    <th>手机号</th>
                    <th>注册时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['phone'] ?: '-'; ?></td>
                    <td><?php echo $user['reg_time']; ?></td>
                    <td class="<?php echo $user['status'] ? 'status-normal' : 'status-banned'; ?>">
                        <?php echo $user['status'] ? '正常' : '已禁用'; ?>
                    </td>
                    <td>
                        <?php if ($user['status']): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="ban" class="btn btn-ban" onclick="return confirm('确定禁用该用户？')">禁用</button>
                        </form>
                        <?php else: ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="unban" class="btn btn-unban">启用</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <script>
        function searchUser() {
            alert('搜索功能开发中');
        }
    </script>
</body>
</html>