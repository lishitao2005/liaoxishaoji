<?php
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>商家帮助 - 辽西烧鸡</title>
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
    <h1>商家帮助</h1>
    <div class="content">
        <p>• 订单问题：下单后可在“我的订单”中查看状态，如有疑问可联系客服。</p>
        <p>• 支付问题：在线支付失败可检查网络或更换支付方式，线下支付需联系客服确认。</p>
        <p>• 物流问题：超过预计时效未收到货，可联系客服查询物流情况。</p>
        <p>• 售后问题：质量问题请在收到货24小时内反馈，我们将尽快处理。</p>
    </div>
    <a href="index.php" class="back-btn">返回首页</a>
</body>
</html>