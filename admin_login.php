<?php
session_start();
if (isset($_SESSION['admin_name'])) {
    header('Location: admin_index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if ($username === 'admin' && $password === '123456') {
        $_SESSION['admin_name'] = $username;
        $_SESSION['is_admin'] = true;
        header('Location: admin_index.php');
        exit;
    } else {
        $error = '用户名或密码错误';
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员登录 - 辽西烧鸡后台</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Microsoft YaHei", sans-serif;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(229, 57, 53, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 20%, rgba(201, 176, 102, 0.15) 0%, transparent 40%);
            animation: pulse 8s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }
        
        .login-container {
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
        }
        
        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 24px;
            box-shadow: 
                0 25px 80px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 10px 30px rgba(26, 26, 46, 0.4);
        }
        
        .logo-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 5px;
        }
        
        .logo-subtitle {
            font-size: 14px;
            color: #636e72;
            font-weight: 500;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            font-size: 14px;
            color: #2d3436;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .form-group input {
            width: 100%;
            height: 52px;
            padding: 0 18px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-group input:focus {
            border-color: #1a1a2e;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(26, 26, 46, 0.1);
        }
        
        .error {
            color: #e53935;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
            padding: 12px;
            background: #fff5f5;
            border-radius: 10px;
            border: 1px solid #ffcdd2;
        }
        
        .btn-submit {
            width: 100%;
            height: 52px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(26, 26, 46, 0.3);
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(26, 26, 46, 0.4);
        }
        
        .link-area {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #636e72;
        }
        
        .link-area a {
            color: #1a1a2e;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .link-area a:hover {
            color: #e53935;
        }
        
        .hint {
            text-align: center;
            font-size: 12px;
            color: #b2bec3;
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .hint strong {
            color: #1a1a2e;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-section">
                <div class="logo-icon">🐔</div>
                <div class="logo-title">辽西烧鸡</div>
                <div class="logo-subtitle">后台管理系统</div>
            </div>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="post">
                <div class="form-group">
                    <label>用户名</label>
                    <input type="text" name="username" placeholder="请输入用户名" required>
                </div>
                
                <div class="form-group">
                    <label>密码</label>
                    <input type="password" name="password" placeholder="请输入密码" required>
                </div>
                
                <button type="submit" class="btn-submit">登 录</button>
            </form>
            
            <div class="link-area">
                <a href="denglu.php">用户登录</a> · <a href="index.php">返回首页</a>
            </div>
            
            <div class="hint">
                <strong>提示：</strong>默认账号 <strong>admin</strong>，密码 <strong>123456</strong>
            </div>
        </div>
    </div>
</body>
</html>