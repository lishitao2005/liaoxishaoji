<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);
    $phone = trim($_POST['phone']);
    
    if (empty($username) || empty($password) || empty($repassword)) {
        $error = '请填写完整信息';
    } elseif ($password !== $repassword) {
        $error = '两次输入的密码不一致';
    } elseif (strlen($password) < 6) {
        $error = '密码长度至少6位';
    } else {
        $users = json_decode(file_get_contents('data/users.json'), true) ?: [];
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $error = '用户名已存在';
                break;
            }
        }
        if (!$error) {
            $users[] = [
                'id' => count($users) + 1,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'phone' => $phone,
                'reg_time' => date('Y-m-d H:i:s'),
                'status' => 1
            ];
            file_put_contents('data/users.json', json_encode($users));
            header('Location: denglu.php?msg=注册成功，请登录');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户注册 - 辽西烧鸡</title>
    <link href="index.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #c9b066 0%, #d4af37 50%, #e6c88a 100%);
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
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 50%);
            animation: rotate 25s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .register-container {
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 1;
        }
        
        .register-box {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 35px;
        }
        
        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #c9b066 0%, #d4af37 100%);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            box-shadow: 0 10px 30px rgba(201, 176, 102, 0.4);
        }
        
        .title {
            font-size: 28px;
            color: #1a1a2e;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .subtitle {
            font-size: 14px;
            color: #636e72;
            font-weight: 500;
        }
        
        .form-group {
            margin-bottom: 22px;
        }
        
        .form-group label {
            display: block;
            font-size: 14px;
            color: #2d3436;
            margin-bottom: 8px;
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
            border-color: #c9b066;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(201, 176, 102, 0.15);
        }
        
        .form-hint {
            font-size: 12px;
            color: #b2bec3;
            margin-top: 6px;
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
            background: linear-gradient(135deg, #c9b066 0%, #d4af37 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(201, 176, 102, 0.4);
            margin-top: 10px;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(201, 176, 102, 0.5);
        }
        
        .link-area {
            text-align: center;
            margin-top: 28px;
            font-size: 14px;
            color: #636e72;
        }
        
        .link-area a {
            color: #c9b066;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .link-area a:hover {
            color: #b39c52;
        }
        
        .agreement {
            font-size: 12px;
            color: #b2bec3;
            text-align: center;
            margin-top: 20px;
            line-height: 1.6;
        }
        
        .agreement a {
            color: #c9b066;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-box">
            <div class="logo-section">
                <div class="logo-icon">🐔</div>
                <h1 class="title">创建账号</h1>
                <p class="subtitle">加入辽西烧鸡，品味百年传承</p>
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
                    <input type="password" name="password" placeholder="请输入密码（至少6位）" required>
                    <div class="form-hint">建议使用字母、数字组合</div>
                </div>
                
                <div class="form-group">
                    <label>确认密码</label>
                    <input type="password" name="repassword" placeholder="请再次输入密码" required>
                </div>
                
                <div class="form-group">
                    <label>手机号（选填）</label>
                    <input type="tel" name="phone" placeholder="请输入手机号">
                </div>
                
                <button type="submit" class="btn-submit">注 册</button>
            </form>
            
            <div class="link-area">
                已有账号？<a href="denglu.php">立即登录</a>
            </div>
            
            <div class="agreement">
                注册即表示同意<a href="#">《用户协议》</a>和<a href="#">《隐私政策》</a>
            </div>
        </div>
    </div>
</body>
</html>