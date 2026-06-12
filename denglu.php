<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$error = '';
$msg = '';
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        $error = '请填写用户名和密码';
    } else {
        $users = json_decode(file_get_contents('data/users.json'), true) ?: [];
        $found = false;
        foreach ($users as $user) {
            if ($user['username'] === $username && password_verify($password, $user['password'])) {
                if (!$user['status']) {
                    $error = '账号已被禁用，请联系管理员';
                    break;
                }
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = false;
                header('Location: index.php');
                exit;
            }
        }
        if (!$found && !$error) {
            $error = '用户名或密码错误';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户登录 - 辽西烧鸡</title>
    <link href="index.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e53935 0%, #ff6f60 50%, #ff8a80 100%);
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
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }
        
        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #e53935 0%, #ff6f60 100%);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            box-shadow: 0 10px 30px rgba(229, 57, 53, 0.4);
        }
        
        .title {
            font-size: 28px;
            color: #1a1a2e;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        
        .subtitle {
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
        
        .input-wrapper {
            position: relative;
        }
        
        .input-wrapper::before {
            content: '';
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-size: contain;
            opacity: 0.5;
        }
        
        .form-group input {
            width: 100%;
            height: 55px;
            padding: 0 20px 0 50px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-group input:focus {
            border-color: #e53935;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(229, 57, 53, 0.1);
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
        
        .msg {
            color: #2e7d32;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
            padding: 12px;
            background: #f1f8f1;
            border-radius: 10px;
            border: 1px solid #c8e6c9;
        }
        
        .btn-submit {
            width: 100%;
            height: 55px;
            background: linear-gradient(135deg, #e53935 0%, #ff6f60 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(229, 57, 53, 0.4);
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(229, 57, 53, 0.5);
        }
        
        .btn-submit:active {
            transform: translateY(-1px);
        }
        
        .link-area {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #636e72;
        }
        
        .link-area a {
            color: #e53935;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .link-area a:hover {
            color: #c62828;
        }
        
        .admin-link {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e8e8e8;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: #b2bec3;
            font-size: 13px;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e8e8e8;
        }
        
        .divider span {
            padding: 0 15px;
        }
        
        .social-login {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid #e8e8e8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 20px;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-section">
                <div class="logo-icon">🐔</div>
                <h1 class="title">欢迎回来</h1>
                <p class="subtitle">登录辽西烧鸡，开始美食之旅</p>
            </div>
            
            <?php if ($msg): ?>
                <div class="msg"><?php echo $msg; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="post">
                <div class="form-group">
                    <label>用户名</label>
                    <div class="input-wrapper">
                        <input type="text" name="username" placeholder="请输入用户名" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>密码</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" placeholder="请输入密码" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-submit">登 录</button>
            </form>
            
            <div class="link-area">
                还没有账号？<a href="zhuce.php">立即注册</a>
            </div>
            
            <div class="admin-link link-area">
                <a href="admin_login.php">管理员登录</a> · <a href="index.php">返回首页</a>
            </div>
        </div>
    </div>
</body>
</html>