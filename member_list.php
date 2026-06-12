<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
$admin_level = $_SESSION['admin_level'];
$admin_name = $_SESSION['admin_name'];

// 权限等级说明
$level_text = [9 => '超级管理员', 3 => '会员管理员', 2 => '商品管理员', 1 => '普通管理员'];
$current_level = $level_text[$admin_level] ?? '未知权限';

// 数据库连接
$conn = mysqli_connect('localhost', 'root', 'root', 'liaoxi_chicken');
if (!$conn) die("数据库连接失败：" . mysqli_connect_error());
mysqli_set_charset($conn, 'utf8');

$msg = '';

// 处理删除会员
if (isset($_GET['del_id'])) {
    $del_id = intval($_GET['del_id']);
    mysqli_query($conn, "DELETE FROM user WHERE user_id = $del_id");
    header("Location: member_list.php?msg=delok");
    exit;
}

if (isset($_GET['msg']) && $_GET['msg'] == 'delok') {
    $msg = "删除成功！";
}

// 处理搜索
$search = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$where = '';
if (!empty($search)) {
    $search_escaped = mysqli_real_escape_string($conn, $search);
    $where = " WHERE username LIKE '%$search_escaped%' OR realname LIKE '%$search_escaped%' OR phone LIKE '%$search_escaped%'";
}

// 分页
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$pagesize = 10;
$offset = ($page - 1) * $pagesize;

// 总数
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS num FROM user $where"))['num'];
$totalpage = ceil($total / $pagesize);

// 会员列表
$sql = "SELECT * FROM user $where ORDER BY user_id DESC LIMIT $offset, $pagesize";
$res = mysqli_query($conn, $sql);
$member_list = [];
while ($row = mysqli_fetch_assoc($res)) $member_list[] = $row;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<title>会员管理 - 沟帮子烧鸡后台</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:"Microsoft YaHei",sans-serif;}
.admin-header{background:#c9b066;color:#fff;height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 30px;}
.admin-header .logo{font-size:22px;font-weight:bold;}
.admin-header .user-info{display:flex;align-items:center;gap:20px;}
.admin-header .logout-btn{color:#fff;text-decoration:none;background:rgba(255,255,255,0.2);padding:6px 15px;border-radius:3px;}
.admin-header .logout-btn:hover{background:rgba(255,255,255,0.3);}
.admin-main{display:flex;min-height:calc(100vh - 60px);}
.admin-sidebar{width:200px;background:#2d3748;color:#fff;}
.admin-sidebar .menu-item{padding:15px 20px;cursor:pointer;transition:background 0.3s;}
.admin-sidebar .menu-item:hover,.admin-sidebar .menu-item.active{background:#4a5568;}
.admin-sidebar .menu-item a{color:#fff;text-decoration:none;display:block;}
.admin-content{flex:1;padding:30px;background:#f5f5f5;}
.msg{padding:10px;background:#dff0d8;color:#3c763d;border-radius:3px;margin-bottom:15px;}
.search-bar{background:#fff;padding:15px 20px;border-radius:5px;box-shadow:0 0 5px rgba(0,0,0,0.1);margin-bottom:20px;display:flex;gap:10px;align-items:center;}
.search-bar input{padding:8px 12px;border:1px solid #ddd;border-radius:3px;width:250px;font-size:14px;}
.search-bar button{background:#c9b066;color:#fff;border:none;padding:8px 20px;border-radius:3px;cursor:pointer;font-size:14px;}
.search-bar button:hover{background:#b89d4a;}
.table{width:100%;border-collapse:collapse;background:#fff;border-radius:5px;overflow:hidden;box-shadow:0 0 5px rgba(0,0,0,0.1);}
.table th,.table td{padding:12px 15px;text-align:center;border-bottom:1px solid #eee;}
.table th{background:#c9b066;color:#fff;font-size:14px;}
.table tr:hover{background:#faf5ee;}
.btn-del{background:#d9534f;color:#fff;border:none;padding:5px 12px;border-radius:3px;cursor:pointer;font-size:13px;}
.btn-del:hover{background:#c9302c;}
.pages{margin-top:20px;text-align:center;}
.pages a{display:inline-block;padding:6px 12px;margin:0 3px;border:1px solid #ccc;text-decoration:none;color:#333;border-radius:3px;}
.pages a.active{background:#c9b066;color:#fff;border-color:#c9b066;}
.pages a:hover:not(.active){background:#f0f0f0;}
.stat-bar{display:flex;gap:15px;margin-bottom:20px;}
.stat-bar .stat-box{background:#fff;padding:15px 25px;border-radius:5px;box-shadow:0 0 5px rgba(0,0,0,0.1);text-align:center;}
.stat-bar .stat-box .num{font-size:28px;color:#c9b066;font-weight:bold;}
.stat-bar .stat-box .label{font-size:13px;color:#666;margin-top:5px;}
</style>
</head>
<body>
<!-- 顶部导航 -->
<div class="admin-header">
    <div class="logo">沟帮子烧鸡 - 后台管理系统</div>
    <div class="user-info">
        <span>欢迎：<?php echo $admin_name; ?>（<?php echo $current_level; ?>）</span>
        <a href="admin_logout.php" class="logout-btn">退出登录</a>
    </div>
</div>

<!-- 主体 -->
<div class="admin-main">
    <!-- 左侧菜单 -->
    <div class="admin-sidebar">
        <div class="menu-item">
            <a href="admin_index.php">后台首页</a>
        </div>
        <?php if($admin_level >= 2): ?>
        <div class="menu-item">
            <a href="goods_list.php">商品管理</a>
        </div>
        <div class="menu-item">
            <a href="goods_search.php">商品查询</a>
        </div>
        <?php endif; ?>
        <div class="menu-item active">
            <a href="member_list.php">会员管理</a>
        </div>
    </div>

    <!-- 右侧内容区 -->
    <div class="admin-content">
        <?php if ($msg) echo "<div class='msg'>$msg</div>"; ?>

        <!-- 统计 -->
        <div class="stat-bar">
            <div class="stat-box">
                <div class="num"><?php echo $total; ?></div>
                <div class="label">会员总数</div>
            </div>
        </div>

        <!-- 搜索栏 -->
        <div class="search-bar">
            <form method="get" style="display:flex;gap:10px;align-items:center;width:100%;">
                <input type="text" name="keyword" placeholder="搜索用户名/姓名/手机号" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">搜索</button>
                <?php if (!empty($search)): ?>
                    <a href="member_list.php" style="color:#666;text-decoration:none;font-size:14px;">清除搜索</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- 会员列表 -->
        <table class="table">
            <thead>
            <tr>
                <th>会员ID</th>
                <th>用户名</th>
                <th>真实姓名</th>
                <th>手机号</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($member_list)) { ?>
                <tr><td colspan="5">暂无会员数据</td></tr>
            <?php } else {
                foreach ($member_list as $m) { ?>
                    <tr>
                        <td><?php echo $m['user_id'] ?></td>
                        <td><?php echo htmlspecialchars($m['username']) ?></td>
                        <td><?php echo htmlspecialchars($m['realname'] ?? '') ?></td>
                        <td><?php echo htmlspecialchars($m['phone'] ?? '') ?></td>
                        <td>
                            <button class="btn-del" onclick="if(confirm('确定删除该会员？')) location.href='?del_id=<?php echo $m['user_id'] ?>'">删除</button>
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>

        <!-- 分页 -->
        <div class="pages">
            <?php if ($page > 1) { ?>
                <a href="?page=<?php echo $page - 1 ?>&keyword=<?php echo urlencode($search) ?>">上一页</a>
            <?php }
            for ($i = 1; $i <= $totalpage; $i++) { ?>
                <a href="?page=<?php echo $i ?>&keyword=<?php echo urlencode($search) ?>" class="<?php echo $i == $page ? 'active' : '' ?>"><?php echo $i ?></a>
            <?php }
            if ($page < $totalpage) { ?>
                <a href="?page=<?php echo $page + 1 ?>&keyword=<?php echo urlencode($search) ?>">下一页</a>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>
