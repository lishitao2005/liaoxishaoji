<?php
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>购物流程 - 辽西烧鸡</title>
    <style>
        body { 
            font-family: "Microsoft YaHei", sans-serif; 
            max-width: 1180px; 
            margin: 50px auto; 
            padding: 0 20px; 
            color: #333; 
        }
        h1 { 
            color: #c9b066; 
            border-bottom: 1px solid #eee; 
            padding-bottom: 10px; 
        }
        .content { 
            margin: 30px 0; 
            line-height: 1.8; 
            font-size: 16px; 
        }
        .back-btn { 
            display: inline-block; 
            margin-top: 30px; 
            padding: 10px 20px; 
            background: #c9b066; 
            color: #fff; 
            text-decoration: none; 
            border-radius: 4px; 
        }
        .back-btn:hover { 
            background: #b89d4a; 
        }
    </style>
</head>
<body>
    <h1>购物流程</h1>
    <div class="content">
        <p>1. 浏览商品，选择心仪的烧鸡/猪蹄/干豆腐等产品</p>
        <p>2. 点击商品进入详情页，加入购物车</p>
        <p>3. 进入购物车，确认订单信息</p>
        <p>4. 选择支付方式（在线支付/线下支付）完成付款</p>
        <p>5. 等待商家发货，查看物流信息</p>
        <p>6. 收到商品，确认收货，完成购物</p>
    </div>
 
    <h1>会员介绍</h1>
    <div class="content">
        <p>• 注册会员：在网站注册即可成为普通会员，享受基础购物服务</p>
        <p>• 会员权益：积分累计、生日福利、新品优先购</p>
        <p>• 积分规则：每消费1元累计1积分，积分可兑换优惠券或礼品</p>
        <p>• 升级规则：消费满一定金额可升级为高级会员，享受更多折扣</p>
    </div>
    <a href="index.php" class="back-btn">返回首页</a>
</body>
</html>
