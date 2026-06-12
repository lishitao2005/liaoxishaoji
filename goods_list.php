<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
$admin_level = $_SESSION['admin_level'];
if ($admin_level < 2) {
    die("权限不足");
}

// 数据库连接
$conn = mysqli_connect('localhost', 'root', 'root', 'liaoxi_chicken');
if (!$conn) die("数据库连接失败：" . mysqli_connect_error());
mysqli_set_charset($conn, 'utf8');

$msg = '';

// 处理添加商品
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_goods'])) {
    $pro_name = trim($_POST['pro_name']);
    $cate_id = intval($_POST['cate_id']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $create_time = $_POST['create_time'];
    $shelf_life = intval($_POST['shelf_life']);
    $pro_desc = trim($_POST['pro_desc']);
    $pic = '';

    // 处理图片上传
    if (!empty($_FILES['pic']['name'])) {
        $updir = 'images/';
        if (!is_dir($updir)) mkdir($updir, 0777, true);
        $ext = pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
        $picname = date('YmdHis') . '.' . $ext;
        $pic = $updir . $picname;
        move_uploaded_file($_FILES['pic']['tmp_name'], $pic);
    }

    $sql = "INSERT INTO product(pro_name,cate_id,price,stock,pic,pro_desc,create_time,shelf_life) 
            VALUES('$pro_name',$cate_id,$price,$stock,'$pic','$pro_desc','$create_time',$shelf_life)";
    if (mysqli_query($conn, $sql)) {
        $msg = "添加成功！";
    } else {
        $msg = "添加失败：" . mysqli_error($conn);
    }
}

// 处理删除
if (isset($_GET['del_id'])) {
    $del_id = intval($_GET['del_id']);
    mysqli_query($conn, "DELETE FROM product WHERE pro_id = $del_id");
    header("Location: goods_list.php?msg=delok");
    exit;
}

if (isset($_GET['msg']) && $_GET['msg'] == 'delok') {
    $msg = "删除成功！";
}

// 分页
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$pagesize = 10;
$offset = ($page - 1) * $pagesize;

// 总数
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS num FROM product"))['num'];
$totalpage = ceil($total / $pagesize);

// 商品列表
$sql = "SELECT p.*, c.cate_name FROM product p LEFT JOIN category c ON p.cate_id=c.cate_id ORDER BY p.pro_id DESC LIMIT $offset,$pagesize";
$res = mysqli_query($conn, $sql);
$goods_list = [];
while ($row = mysqli_fetch_assoc($res)) $goods_list[] = $row;

// 分类下拉
$cate_list = mysqli_query($conn, "SELECT * FROM category");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<title>商品管理 - 沟帮子烧鸡</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:"Microsoft YaHei",sans-serif;}
.header{background:#c9b066;color:#fff;height:60px;line-height:60px;padding:0 30px;display:flex;justify-content:space-between;}
.header .title{font-size:20px;font-weight:bold;}
.header .back{color:#fff;text-decoration:none;background:rgba(255,255,255,0.2);padding:6px 15px;border-radius:3px;line-height:normal;}
.container{padding:30px;background:#f5f5f5;min-height:calc(100vh - 60px);}
.msg{padding:10px;background:#dff0d8;color:#3c763d;border-radius:3px;margin-bottom:15px;}

/* 顶部添加表单样式（和你参考的界面一致） */
.add-form{background:#fff;padding:20px;border-radius:5px;box-shadow:0 0 5px rgba(0,0,0,0.1);margin-bottom:20px;}
.add-form .row{display:flex;flex-wrap:wrap;gap:15px;align-items:flex-end;}
.add-form .form-item{display:flex;flex-direction:column;gap:5px;}
.add-form label{font-size:14px;color:#333;}
.add-form input,.add-form select{padding:8px;border:1px solid #ddd;border-radius:3px;width:180px;}
.add-form .btn-add{background:#c9b066;color:#fff;border:none;padding:8px 20px;border-radius:3px;cursor:pointer;}
.add-form .btn-add:hover{background:#b89d4a;}

/* 商品列表样式 */
.table{width:100%;border-collapse:collapse;background:#fff;border-radius:5px;overflow:hidden;box-shadow:0 0 5px rgba(0,0,0,0.1);}
.table th,.table td{padding:12px;text-align:center;border-bottom:1px solid #eee;}
.table th{background:#c9b066;color:#fff;}
.table tr:hover{background:#f9f9f9;}
.img{width:60px;height:60px;object-fit:cover;border-radius:3px;}
.btn-del{background:#d9534f;color:#fff;border:none;padding:6px 12px;border-radius:3px;cursor:pointer;}
.btn-del:hover{background:#c9302c;}
.pages{margin-top:20px;text-align:center;}
.pages a{display:inline-block;padding:6px 12px;margin:0 3px;border:1px solid #ccc;text-decoration:none;color:#333;}
.pages a.active{background:#c9b066;color:#fff;border-color:#c9b066;}
</style>
</head>
<body>
<div class="header">
    <div class="title">沟帮子烧鸡 - 商品管理</div>
    <a href="admin_index.php" class="back">返回首页</a>
</div>
<div class="container">
    <?php if ($msg) echo "<div class='msg'>$msg</div>"; ?>

    <!-- 顶部添加商品表单（固定显示，和你参考的界面一致） -->
    <div class="add-form">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-item">
                    <label>商品名称</label>
                    <input type="text" name="pro_name" required>
                </div>
                <div class="form-item">
                    <label>价格</label>
                    <input type="number" step="0.01" name="price" required>
                </div>
                <div class="form-item">
                    <label>库存数量</label>
                    <input type="number" name="stock" required>
                </div>
                <div class="form-item">
                    <label>所属分类</label>
                    <select name="cate_id" required>
                        <option value="">请选择分类</option>
                        <?php while ($cate = mysqli_fetch_assoc($cate_list)) { ?>
                            <option value="<?php echo $cate['cate_id'] ?>"><?php echo $cate['cate_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-top:15px;">
                <div class="form-item">
                    <label>生产日期</label>
                    <input type="date" name="create_time" required>
                </div>
                <div class="form-item">
                    <label>保质期（天）</label>
                    <input type="number" name="shelf_life" required>
                </div>
                <div class="form-item">
                    <label>商品图片</label>
                    <input type="file" name="pic" accept="image/*">
                </div>
                <div class="form-item">
                    <label>&nbsp;</label>
                    <button type="submit" name="add_goods" class="btn-add">添加商品</button>
                </div>
            </div>
        </form>
    </div>

    <!-- 商品列表 -->
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>图片</th>
            <th>商品名称</th>
            <th>分类</th>
            <th>价格</th>
            <th>库存</th>
            <th>生产日期</th>
            <th>保质期</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($goods_list)) { ?>
            <tr><td colspan="9">暂无商品</td></tr>
        <?php } else {
            foreach ($goods_list as $g) { ?>
                <tr>
                    <td><?php echo $g['pro_id'] ?></td>
                    <td>
                        <?php if (!empty($g['pic']) && file_exists($g['pic'])) { ?>
                            <img src="<?php echo htmlspecialchars($g['pic']) ?>" class="img">
                        <?php } else { ?>
                            无图
                        <?php } ?>
                    </td>
                    <td><?php echo htmlspecialchars($g['pro_name']) ?></td>
                    <td><?php echo $g['cate_name'] ?></td>
                    <td>¥<?php echo number_format($g['price'], 2) ?></td>
                    <td><?php echo $g['stock'] ?></td>
                    <td><?php echo $g['create_time'] ?></td>
                    <td><?php echo $g['shelf_life'] ?></td>
                    <td>
                        <button class="btn-del" onclick="if(confirm('确定删除？')) location.href='?del_id=<?php echo $g['pro_id'] ?>'">删除</button>
                    </td>
                </tr>
            <?php }
        } ?>
        </tbody>
    </table>

    <!-- 分页 -->
    <div class="pages">
        <?php if ($page > 1) { ?>
            <a href="?page=<?php echo $page - 1 ?>">上一页</a>
        <?php }
        for ($i = 1; $i <= $totalpage; $i++) { ?>
            <a href="?page=<?php echo $i ?>" class="<?php echo $i == $page ? 'active' : '' ?>"><?php echo $i ?></a>
        <?php }
        if ($page < $totalpage) { ?>
            <a href="?page=<?php echo $page + 1 ?>">下一页</a>
        <?php } ?>
    </div>
</div>
</body>
</html>