<?php
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>在线支付 - 辽西烧鸡</title>
    <style>
        body { font-family: "Microsoft YaHei", sans-serif; max-width: 1180px; margin: 50px auto; padding: 0 20px; color: #333; }
        h1 { color: #c9b066; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .content { margin: 30px 0; line-height: 1.8; font-size: 16px; }
        .back-btn { display: inline-block; margin-top: 30px; padding: 10px 20px; background: #c9b066; color: #fff; text-decoration: none; border-radius: 4px; }
        .back-btn:hover { background: #b89d4a; }
    </style>
</head>
<body>
    <h1>在线支付</h1>
    <div class="content">
        <p>• 支持渠道：微信支付、支付宝、银行卡支付</p>
        <p>• 支付流程：确认订单 → 选择在线支付 → 跳转支付页面完成付款</p>
        <p>• 安全保障：所有支付通道均加密处理，保障资金安全</p>
        <p>• 订单状态：支付成功后订单自动更新，可在“我的订单”中查看</p>

<?php
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>线下支付 - 辽西烧鸡</title>
    <style>
        body { font-family: "Microsoft YaHei", sans-serif; max-width: 1180px; margin: 50px auto; padding: 0 20px; color: #333; }
        h1 { color: #c9b066; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .content { margin: 30px 0; line-height: 1.8; font-size: 16px; }
        .back-btn { display: inline-block; margin-top: 30px; padding: 10px 20px; background: #c9b066; color: #fff; text-decoration: none; border-radius: 4px; }
        .back-btn:hover { background: #b89d4a; }
    </style>
</head>
<body>
    <h1>线下支付</h1>
    <div class="content">
        <p>• 支付方式：银行转账、门店现金支付</p>
        <p>• 转账说明：下单后联系客服获取收款账号，转账时备注订单号</p>
        <p>• 门店支付：可前往辽西烧鸡线下门店直接付款取货</p>
        <p>• 到账确认：转账后需将凭证发送给客服，确认到账后安排发货</p>
    </div>
    <a href="index.php" class="back-btn">返回首页</a>
</body>
</html>