<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('Location: admin_login.php');
    exit;
}

$goods = json_decode(file_get_contents('data/goods.json'), true) ?: [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $id = intval($_POST['id']);
        $goods = array_filter($goods, function($g) use ($id) {
            return $g['id'] != $id;
        });
        file_put_contents('data/goods.json', json_encode(array_values($goods)));
        header('Location: admin_goods.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品管理 - 辽西烧鸡后台</title>
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
        .section { background:#fff; border-radius:8px; padding:25px; box-shadow:0 0 10px rgba(0,0,0,0.1); margin-bottom:20px; }
        .section-title { font-size:18px; margin-bottom:20px; padding-bottom:10px; border-bottom:1px solid #eee; }
        .table { width:100%; border-collapse:collapse; }
        .table th, .table td { padding:12px; text-align:left; border-bottom:1px solid #eee; }
        .table th { background:#f5f5f5; font-weight:bold; }
        .table tr:hover { background:#f9f9f9; }
        .btn { padding:6px 15px; border:none; border-radius:4px; cursor:pointer; font-size:14px; }
        .btn-add { background:#e53935; color:#fff; float:right; margin-bottom:15px; }
        .btn-edit { background:#42a5f5; color:#fff; }
        .btn-delete { background:#ef5350; color:#fff; }
        .btn:hover { opacity:0.9; }
        .search-bar { margin-bottom:20px; display:flex; gap:15px; }
        .search-bar input { flex:1; padding:10px; border:1px solid #ddd; border-radius:4px; }
        .goods-img { width:60px; height:60px; object-fit:cover; border-radius:4px; }
        .modal { display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:1000; }
        .modal-content { background:#fff; padding:30px; border-radius:8px; width:500px; }
        .form-group { margin-bottom:20px; }
        .form-group label { display:block; margin-bottom:8px; }
        .form-group input, .form-group textarea { width:100%; padding:10px; border:1px solid #ddd; border-radius:4px; }
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
            <li><a href="admin_goods.php" class="active">商品管理</a></li>
            <li><a href="admin_member.php">会员管理</a></li>
            <li><a href="admin_order.php">订单管理</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="section">
            <button class="btn btn-add" onclick="showAddModal()">添加商品</button>
            <div class="section-title">商品列表</div>
            <div class="search-bar">
                <input type="text" placeholder="搜索商品名称" id="searchInput">
                <button class="btn btn-edit" onclick="searchGoods()">搜索</button>
            </div>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>商品图片</th>
                    <th>商品名称</th>
                    <th>价格</th>
                    <th>库存</th>
                    <th>销量</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($goods as $item): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><img src="images/<?php echo $item['image']; ?>" class="goods-img"></td>
                    <td><?php echo $item['name']; ?></td>
                    <td>¥<?php echo $item['price']; ?></td>
                    <td><?php echo $item['stock']; ?></td>
                    <td><?php echo $item['sales']; ?></td>
                    <td>
                        <button class="btn btn-edit" onclick="editGoods(<?php echo $item['id']; ?>)">编辑</button>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-delete" onclick="return confirm('确定删除？')">删除</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="modal" id="addModal">
        <div class="modal-content">
            <h3 style="margin-bottom:20px;">添加商品</h3>
            <form method="post" action="goods_action.php" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label>商品名称</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>商品价格</label>
                    <input type="number" name="price" step="0.01" required>
                </div>
                <div class="form-group">
                    <label>库存数量</label>
                    <input type="number" name="stock" required>
                </div>
                <div class="form-group">
                    <label>商品描述</label>
                    <textarea name="desc" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>商品图片</label>
                    <input type="file" name="image">
                </div>
                <button type="submit" class="btn btn-add" style="width:100%;">添加</button>
                <button type="button" class="btn btn-edit" style="width:100%; margin-top:10px;" onclick="closeModal()">取消</button>
            </form>
        </div>
    </div>
    <script>
        function showAddModal() {
            document.getElementById('addModal').style.display = 'flex';
        }
        function closeModal() {
            document.getElementById('addModal').style.display = 'none';
        }
        function editGoods(id) {
            alert('编辑功能开发中');
        }
        function searchGoods() {
            alert('搜索功能开发中');
        }
    </script>
</body>
</html>