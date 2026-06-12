# 辽西烧鸡电商网站 - 项目交接文档

## 项目概述
- **项目名称**: 辽西烧鸡电商平台
- **域名**: liaoxishaoji.top
- **项目路径**: d:\liaoxishaoji
- **技术栈**: PHP + HTML + CSS + JavaScript + JSON数据存储

---

## 当前状态

### ✅ 已完成
1. 首页 (index.php) - 包含轮播图、商品列表
2. 商品详情页 (xiangqingye.php) - 8个商品详情
3. 商品列表页 (goods-list.php) - 商品分类筛选
4. 品牌故事页 (brand-story.php) - 企业历史介绍
5. 用户注册页 (zhuce.php)
6. 用户登录页 (denglu.php)
7. 退出登录页 (logout.php)
8. 后台管理登录页 (admin_login.php)
9. 后台首页 (admin_index.php) - 数据仪表盘
10. 商品管理页 (admin_goods.php)
11. 会员管理页 (admin_member.php)
12. 订单管理页 (admin_order.php)
13. 后台退出页 (admin_logout.php)

### ⚠️ 待解决问题
1. **轮播图**: 已修复滚动功能，高度改为350px
2. **商品详情页**: 已修复，数据嵌入PHP文件
3. **域名链接**: 需要用户手动配置GitHub Pages + Cloudflare

---

## 文件结构

```
d:\liaoxishaoji/
├── index.php              # 首页（轮播图+商品列表）
├── xiangqingye.php        # 商品详情页
├── goods-list.php         # 商品列表页
├── brand-story.php        # 品牌故事页
├── zhuce.php              # 用户注册页
├── denglu.php             # 用户登录页
├── logout.php             # 用户退出页
├── admin_login.php        # 管理员登录页
├── admin_index.php        # 后台首页
├── admin_goods.php        # 商品管理页
├── admin_member.php       # 会员管理页
├── admin_order.php        # 订单管理页
├── admin_logout.php       # 管理员退出页
├── index.css              # 主样式文件
├── .github/workflows/deploy.yml  # GitHub Actions配置
├── DOMAIN_SETUP.md        # 域名配置指南
├── DEPLOYMENT.md          # 部署说明
├── images/                # 商品图片（15张）
│   ├── 1.jpg ~ 15.jpg
├── data/                  # 数据文件
│   ├── goods.json         # 商品数据
│   ├── users.json         # 用户数据
│   └── orders.json        # 订单数据
└── js/                    # JavaScript文件
    ├── jquery.js
    └── slider.js
```

---

## 商品数据

| ID | 名称 | 价格 | 图片 |
|----|------|------|------|
| 1 | 干豆腐 | ¥46.30 | 7.jpg |
| 2 | 烧鸡 | ¥42.70 | 1.jpg |
| 3 | 猪蹄 | ¥49.10 | 6.jpg |
| 4 | 火腿肠 | ¥35.00 | 8.jpg |
| 5 | 熏鸡 | ¥38.50 | 2.jpg |
| 6 | 酱牛肉 | ¥58.00 | 3.jpg |
| 7 | 卤鸭 | ¥45.80 | 4.jpg |
| 8 | 香肠 | ¥32.00 | 5.jpg |

---

## 登录信息

| 用户类型 | 账号 | 密码 |
|---------|------|------|
| 管理员 | admin | 123456 |
| 测试用户 | testuser | password |

---

## 域名配置步骤

### GitHub Pages配置
1. 创建GitHub仓库 `liaoxishaoji`
2. 上传项目所有文件
3. Settings → Pages → Source: GitHub Actions
4. 等待部署完成

### Cloudflare配置
1. 添加站点 liaoxishaoji.top
2. 添加DNS记录：
   - A记录: @ → 185.199.108.153
   - A记录: @ → 185.199.109.153
   - A记录: @ → 185.199.110.153
   - A记录: @ → 185.199.111.153
3. 更改域名DNS服务器为Cloudflare提供的地址

---

## 用户需求（原始）

1. 域名使用 liaoxishaoji.top
2. 使用 Cloudflare + GitHub Pages 方式链接域名
3. 图片不要用圆角
4. 品牌故事要能打开，内容真实
5. 所有页面都要能打开
6. 后台要有订单管理、会员管理、商品管理
7. 商品详情页要完整
8. 轮播图要能滚动

---

## 技术说明

### PHP环境要求
- PHP 7.4+
- 无需数据库，使用JSON文件存储数据

### 本地测试
```bash
# 使用PHP内置服务器
php -S localhost:8080

# 或使用Python HTTP服务器（不支持PHP）
python -m http.server 8080
```

### 注意事项
- 商品详情页数据已嵌入PHP文件，不依赖外部JSON
- 轮播图使用纯JavaScript实现，无需jQuery
- 后台管理功能完整，可添加/删除商品

---

## 下一步工作建议

1. 用户需要手动配置GitHub和Cloudflare账号
2. 上传项目到GitHub仓库
3. 配置域名DNS解析
4. 等待DNS生效后访问 https://liaoxishaoji.top

---

## 相关文档

- [DOMAIN_SETUP.md](file:///d:/liaoxishaoji/DOMAIN_SETUP.md) - 详细域名配置指南
- [DEPLOYMENT.md](file:///d:/liaoxishaoji/DEPLOYMENT.md) - 部署说明