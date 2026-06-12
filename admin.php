<?php
session_start();

// 数据库配置（和你项目完全一致）
$host = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$dbname = 'liaoxi_chicken';

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) die("数据库连接失败");
$conn->set_charset("utf8mb4");

// 管理员账号密码（你可以自己改）
$admin_user = "admin";
$admin_pwd  = "123456";

// 检查是否登录
if (!isset($_SESSION['admin_login'])) {
    // 未登录 → 显示登录表单
    if ($_POST) {
        $user = trim($_POST['admin_user']);
        $pwd  = trim($_POST['admin_pwd']);
        
        if ($user === $admin_user && $pwd === $admin_pwd) {
            $_SESSION['admin_login'] = true;
            echo "<script>location='admin.php'</script>";
            exit;
        } else {
            $error = "账号或密码错误";
        }
    }
} else {
    // 已登录 → 加载会员数据
    $result = $conn->query("SELECT * FROM member ORDER BY member_id DESC");
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>沟帮子烧鸡 - 管理员后台</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:微软雅黑}
        body{background:#f7f5f0;color:#333}
        .admin-wrap{width:1200px;margin:50px auto}
        .title{text-align:center;color:#c9b066;margin-bottom:30px}
        .login-box{width:400px;margin:0 auto;background:#fff;padding:40px;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,.08)}
        .login-box h2{color:#c9b066;text-align:center;margin-bottom:20px}
        .form-item{margin-bottom:20px}
        .form-item input{width:100%;height:46px;border:1px solid #ddd;border-radius:6px;padding:0 15px;font-size:15px}
        .btn{width:100%;height:48px;background:#c9b066;color:#fff;border:none;border-radius:6px;font-size:16px;cursor:pointer}
        .error{color:red;text-align:center;margin-bottom:15px}
        .header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
        .logout{color:#c9b066;text-decoration:none}
        table{width:100%;background:#fff;border-collapse:collapse;border-radius:8px;overflow:hidden}
        th,td{padding:15px;text-align:left;border-bottom:1px solid #eee}
        th{background:#c9b066;color:#fff}
        tr:hover{background:#faf5ee}
    </style>
</head>
<body>

<div class="admin-wrap">
    <?php if (!isset($_SESSION['admin_login'])): ?>

        <!-- 管理员登录 -->
        <div class="login-box">
            <h2>管理员登录</h2>
            <?php if(isset($error)):?>
                <div class="error"><?=$error?></div>
            <?php endif?>
            <form method="post">
                <div class="form-item">
                    <input type="text" name="admin_user" placeholder="管理员账号" required>
                </div>
                <div class="form-item">
                    <input type="password" name="admin_pwd" placeholder="管理员密码" required>
                </div>
                <button class="btn">登录后台</button>
            </form>
        </div>

    <?php else: ?>

        <!-- 管理员后台 -->
        <div class="header">
            <h1 class="title">沟帮子烧鸡 · 管理员后台</h1>
            <a href="?logout=1" class="logout">退出登录</a>
        </div>

        <h3>会员列表</h3>
        <br>
        <table>
            <tr>
                <th>会员ID</th>
                <th>会员账号</th>
                <th>会员姓名</th>
                <th>会员手机</th>
                <th>注册时间</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?=$row['member_id']?></td>
                <td><?=$row['member_account']?></td>
                <td><?=$row['member_name']?></td>
                <td><?=$row['member_phone']?></td>
                <td><?=$row['reg_time']?></td>
            </tr>
            <?php endwhile; ?>
        </table>

    <?php endif; ?>
</div>

<?php
// 退出登录
if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>location='admin.php'</script>";
    exit;
}
?>

</body>
</html>