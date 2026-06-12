<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>品牌故事 - 辽西烧鸡</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Microsoft YaHei", sans-serif;
        }
        
        body {
            background: #f8f9fa;
        }
        
        .topnav {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            height: 50px;
            line-height: 50px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .topnav .con {
            width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .topnav .txt {
            font-size: 14px;
            color: #636e72;
        }
        
        .topnav .rightnav {
            display: flex;
            gap: 35px;
        }
        
        .topnav .rightnav li {
            list-style: none;
        }
        
        .topnav .rightnav li a {
            font-size: 14px;
            color: #2d3436;
            text-decoration: none;
        }
        
        .topnav .rightnav li a:hover {
            color: #e53935;
        }
        
        .header {
            background: #fff;
            height: 120px;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, #e53935 0%, #ff6f60 100%);
        }
        
        .mainso {
            width: 1200px;
            height: 100%;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 80px;
        }
        
        .brand-hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: #fff;
            padding: 80px 0;
            text-align: center;
        }
        
        .brand-hero h1 {
            font-size: 42px;
            margin-bottom: 20px;
        }
        
        .brand-hero p {
            font-size: 18px;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .story-section {
            width: 1200px;
            margin: 60px auto;
        }
        
        .story-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .story-title h2 {
            font-size: 32px;
            color: #2d3436;
            margin-bottom: 15px;
        }
        
        .story-title .line {
            width: 60px;
            height: 3px;
            background: #e53935;
            margin: 0 auto;
        }
        
        .story-content {
            display: flex;
            gap: 50px;
            align-items: center;
            margin-bottom: 80px;
        }
        
        .story-content.reverse {
            flex-direction: row-reverse;
        }
        
        .story-image {
            flex: 1;
        }
        
        .story-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        
        .story-text {
            flex: 1;
        }
        
        .story-text h3 {
            font-size: 24px;
            color: #2d3436;
            margin-bottom: 25px;
        }
        
        .story-text p {
            font-size: 16px;
            color: #636e72;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        
        .timeline {
            background: #fff;
            padding: 60px 0;
        }
        
        .timeline-container {
            width: 1200px;
            margin: 0 auto;
        }
        
        .timeline-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .timeline-title h2 {
            font-size: 32px;
            color: #2d3436;
        }
        
        .timeline-items {
            position: relative;
            padding-left: 50px;
        }
        
        .timeline-items::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e8e8e8;
        }
        
        .timeline-item {
            position: relative;
            padding: 30px 0;
            border-bottom: 1px solid #f1f2f6;
        }
        
        .timeline-item:last-child {
            border-bottom: none;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -40px;
            top: 35px;
            width: 16px;
            height: 16px;
            background: #e53935;
        }
        
        .timeline-year {
            font-size: 28px;
            font-weight: 700;
            color: #e53935;
            margin-bottom: 15px;
        }
        
        .timeline-content {
            font-size: 16px;
            color: #636e72;
            line-height: 1.6;
        }
        
        .features-section {
            padding: 60px 0;
        }
        
        .features-container {
            width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }
        
        .feature-item {
            text-align: center;
        }
        
        .feature-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }
        
        .feature-item h3 {
            font-size: 18px;
            color: #2d3436;
            margin-bottom: 15px;
        }
        
        .feature-item p {
            font-size: 14px;
            color: #636e72;
            line-height: 1.6;
        }
        
        footer {
            background: #2d3436;
            color: #fff;
            padding: 60px 0;
            margin-top: 50px;
        }
        
        .footer-container {
            width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-around;
        }
        
        .footer-nav {
            min-width: 180px;
        }
        
        .footer-nav h2 {
            font-size: 18px;
            margin-bottom: 25px;
        }
        
        .footer-nav li {
            list-style: none;
            margin-bottom: 12px;
        }
        
        .footer-nav li a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
        }
        
        .footer-nav li a:hover {
            color: #e53935;
        }
    </style>
</head>
<body>
    <div class="topnav">
        <div class="con">
            <div class="txt">欢迎您来到辽西烧鸡批发部！</div>
            <ul class="rightnav">
                <li><a href="index.php">首页</a></li>
                <li><a href="brand-story.php">品牌故事</a></li>
                <li><a href="denglu.php">登录</a></li>
                <li><a href="zhuce.php">注册</a></li>
            </ul>
        </div>
    </div>
    
    <header class="header">
        <div class="mainso">
            <div class="logo"><img src="images/9.jpg" /></div>
        </div>
    </header>
    
    <div class="brand-hero">
        <h1>百年传承 匠心制作</h1>
        <p>辽西烧鸡，源自百年古镇沟帮子，传承四代人的匠心技艺，以独特的风味和精湛的工艺闻名遐迩</p>
    </div>
    
    <div class="story-section">
        <div class="story-title">
            <h2>品牌故事</h2>
            <div class="line"></div>
        </div>
        
        <div class="story-content">
            <div class="story-image">
                <img src="images/1.jpg" />
            </div>
            <div class="story-text">
                <h3>百年历史 源远流长</h3>
                <p>辽西烧鸡的历史可以追溯到清朝光绪年间。公元1899年，在辽宁省北镇市沟帮子镇，一位名叫尹玉成的厨师开创了沟帮子熏鸡的先河。</p>
                <p>尹玉成借鉴了宫廷御膳的制作工艺，结合北方传统的熏制方法，选用当地优质的土鸡，配以数十种名贵中草药，经过十数道工序精心制作，终于创造出风味独特的沟帮子熏鸡。</p>
            </div>
        </div>
        
        <div class="story-content reverse">
            <div class="story-image">
                <img src="images/6.jpg" />
            </div>
            <div class="story-text">
                <h3>四代传承 匠心独运</h3>
                <p>从尹玉成创始至今，辽西烧鸡的制作技艺已经传承了四代人。每一代传承人都在坚守传统工艺的基础上，不断探索创新，使这一传统美食得以发扬光大。</p>
                <p>如今，辽西烧鸡不仅在东北地区家喻户晓，更已走向全国，成为中华美食文化的一张亮丽名片。</p>
            </div>
        </div>
        
        <div class="story-content">
            <div class="story-image">
                <img src="images/7.jpg" />
            </div>
            <div class="story-text">
                <h3>古法工艺 现代传承</h3>
                <p>辽西烧鸡的制作工艺十分讲究，从选鸡、宰杀、造型，到煮制、熏烤，每一道工序都精益求精。</p>
                <p>采用传统的"老汤"卤制工艺，汤料由数十种中草药配制而成，经过长时间熬煮，使鸡肉充分吸收汤汁的精华，味道醇厚，香气四溢。</p>
            </div>
        </div>
    </div>
    
    <div class="timeline">
        <div class="timeline-container">
            <div class="timeline-title">
                <h2>发展历程</h2>
            </div>
            <div class="timeline-items">
                <div class="timeline-item">
                    <div class="timeline-year">1899年</div>
                    <div class="timeline-content">尹玉成在沟帮子镇开设熏鸡铺，开创沟帮子熏鸡先河</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">1907年</div>
                    <div class="timeline-content">第二代传人尹俊卿继承家业，扩大经营规模</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">1949年</div>
                    <div class="timeline-content">公私合营，成立沟帮子食品厂</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">1980年</div>
                    <div class="timeline-content">第三代传人恢复传统工艺，产品开始走向全国</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2000年</div>
                    <div class="timeline-content">成立现代化食品加工企业，引进先进生产设备</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2024年</div>
                    <div class="timeline-content">辽西烧鸡品牌正式上线电商平台，开启线上销售新篇章</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="features-section">
        <div class="features-container">
            <div class="feature-item">
                <div class="feature-icon">🐔</div>
                <h3>精选原料</h3>
                <p>选用当地优质土鸡，确保肉质鲜嫩</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon">🌿</div>
                <h3>古法配方</h3>
                <p>数十种中草药配制，风味独特</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon">🔥</div>
                <h3>传统工艺</h3>
                <p>百年传承的熏制技艺</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon">🏆</div>
                <h3>品质保证</h3>
                <p>严格的质量控制体系</p>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="footer-container">
            <div class="footer-nav">
                <h2>购物指南</h2>
                <li><a href="#">购物流程</a></li>
                <li><a href="#">会员介绍</a></li>
            </div>
            <div class="footer-nav">
                <h2>配送方式</h2>
                <li><a href="#">配送服务</a></li>
                <li><a href="#">配送费用</a></li>
            </div>
            <div class="footer-nav">
                <h2>售后服务</h2>
                <li><a href="#">售后政策</a></li>
                <li><a href="#">退款说明</a></li>
            </div>
            <div class="footer-nav">
                <h2>联系方式</h2>
                <li><a href="#">联系客服</a></li>
                <li><a href="#">商家帮助</a></li>
            </div>
        </div>
    </footer>
</body>
</html>