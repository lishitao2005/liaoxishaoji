<?php
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>友情链接 - 辽西烧鸡</title>
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
    <h1>友情链接</h1>
    <div class="content">
        <p>以下为我们的合作伙伴链接：</p>
        <p><a href="https://www.example1.com" target="_blank">食品行业协会官网</a></p>
        <p><a href="https://www.example2.com" target="_blank">本地生活服务平台</a></p>
        <p><a href="https://www.example3.com" target="_blank">冷链物流合作方</a></p>
        <p>如需合作交换链接，请联系客服提交申请。</p>
    </div>
    <a href="index.php" class="back-btn">返回首页</a>
</body>
</html>