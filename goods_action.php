<?php
session_start();
if (empty($_SESSION['admin_id']) || $_SESSION['admin_level'] < 2) {
    exit("权限不足");
}
$conn = mysqli_connect('localhost', 'root', 'root', 'liaoxi_chicken');
if (!$conn) die("数据库连接失败");
mysqli_set_charset($conn, 'utf8');

$act = $_GET['act'] ?? $_POST['act'];
$pro_id = isset($_REQUEST['pro_id']) ? intval($_REQUEST['pro_id']) : 0;

// 获取单个商品（给编辑用）
if ($act == 'get') {
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product WHERE pro_id=$pro_id"));
    echo json_encode($row);
    exit;
}

// 删除
if ($act == 'del') {
    mysqli_query($conn, "DELETE FROM product WHERE pro_id=$pro_id");
    header("Location: goods_list.php?msg=delok");
    exit;
}

// 添加/编辑
$pro_name = trim($_POST['pro_name']);
$cate_id = intval($_POST['cate_id']);
$price = floatval($_POST['price']);
$stock = intval($_POST['stock']);
$create_time = $_POST['create_time'];
$shelf_life = intval($_POST['shelf_life']);
$pro_desc = trim($_POST['pro_desc']);

// 上传图片（如果没有上传新图，保留原路径）
$pic = '';
if (!empty($_FILES['pic']['name'])) {
    $updir = 'uploads/';
    if (!is_dir($updir)) mkdir($updir, 0777, true);
    $ext = pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
    $picname = date('YmdHis') . '.' . $ext;
    $pic = $updir . $picname;
    move_uploaded_file($_FILES['pic']['tmp_name'], $pic);
}

if ($act == 'add') {
    $sql = "INSERT INTO product(pro_name,cate_id,price,stock,pic,pro_desc,create_time,shelf_life) 
            VALUES('$pro_name',$cate_id,$price,$stock,'$pic','$pro_desc','$create_time',$shelf_life)";
    mysqli_query($conn, $sql);
    header("Location: goods_list.php?msg=addok");
} elseif ($act == 'edit') {
    $picstr = $pic ? "pic='$pic'," : "";
    $sql = "UPDATE product 
            SET pro_name='$pro_name',cate_id=$cate_id,price=$price,stock=$stock,$picstr 
                pro_desc='$pro_desc',create_time='$create_time',shelf_life=$shelf_life 
            WHERE pro_id=$pro_id";
    mysqli_query($conn, $sql);
    header("Location: goods_list.php?msg=editok");
}
exit;
?>