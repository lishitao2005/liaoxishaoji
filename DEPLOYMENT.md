# 辽西烧鸡电商网站 - 域名配置说明

## 域名信息
- 域名：liaoxishaoji.top

## 部署方式：GitHub Pages + Cloudflare

### 第一步：创建GitHub仓库

1. 登录 GitHub 账号
2. 创建新仓库，命名为：`liaoxishaoji`
3. 将项目代码上传到仓库

### 第二步：配置GitHub Pages

1. 进入仓库设置（Settings）
2. 找到 Pages 选项
3. 选择部署来源：
   - Source: Deploy from a branch
   - Branch: main / master
   - Folder: / (root)
4. 点击 Save

### 第三步：配置Cloudflare

1. 登录 Cloudflare 账号
2. 添加站点（Add Site）
3. 输入域名：liaoxishaoji.top
4. 选择免费方案
5. 更新域名DNS解析：
   - 添加 A 记录：@ -> 185.199.108.153（GitHub Pages IP）
   - 添加 A 记录：@ -> 185.199.109.153
   - 添加 A 记录：@ -> 185.199.110.153
   - 添加 A 记录：@ -> 185.199.111.153
6. 更改域名注册商的Nameservers为Cloudflare提供的DNS服务器

### 第四步：配置SSL证书

1. 在Cloudflare中启用SSL/TLS
2. 选择 Full 模式
3. 开启 Automatic HTTPS Rewrites

### 第五步：配置页面规则（可选）

- 强制HTTPS重定向
- 设置缓存规则

## 项目结构

```
liaoxishaoji/
├── index.php              # 首页
├── goods-list.php         # 商品列表页
├── xiangqingye.php        # 商品详情页
├── brand-story.php        # 品牌故事页
├── zhuce.php              # 用户注册页
├── denglu.php             # 用户登录页
├── logout.php             # 退出登录页
├── admin_login.php        # 管理员登录页
├── admin_index.php        # 后台首页
├── admin_goods.php        # 商品管理页
├── admin_member.php       # 会员管理页
├── admin_order.php        # 订单管理页
├── admin_logout.php       # 管理员退出页
├── index.css              # 主样式文件
├── images/                # 商品图片目录
└── data/                  # 数据文件目录
    ├── users.json         # 用户数据
    ├── goods.json         # 商品数据
    └── orders.json        # 订单数据
```

## 管理员登录信息

| 用户名 | 密码 |
|--------|------|
| admin  | 123456 |

## 测试用户信息

| 用户名 | 密码 |
|--------|------|
| testuser | password |
| vip001 | password |

## 预览地址

- 开发环境：http://localhost:8080/index.php
- 生产环境：https://liaoxishaoji.top

## 功能清单

### 前台功能
- ✅ 首页轮播图
- ✅ 商品列表展示
- ✅ 商品详情页
- ✅ 用户注册
- ✅ 用户登录
- ✅ 品牌故事页
- ✅ 商品分类筛选

### 后台功能
- ✅ 管理员登录
- ✅ 数据仪表盘
- ✅ 商品管理（查询、添加、删除）
- ✅ 会员管理（查询、禁用/启用）
- ✅ 订单管理

## 技术栈

- PHP 7.4+
- HTML5
- CSS3
- JavaScript
- JSON（数据存储）