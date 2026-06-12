# 域名配置完整指南 - liaoxishaoji.top

## 前提条件
- 你需要有一个 GitHub 账号
- 你需要有一个 Cloudflare 账号
- 你需要拥有 liaoxishaoji.top 域名（已在域名服务商购买）

---

## 第一步：上传项目到GitHub

### 1.1 创建GitHub仓库
1. 打开浏览器，访问 https://github.com
2. 登录你的GitHub账号
3. 点击右上角的 "+" → "New repository"
4. 填写仓库信息：
   - Repository name: `liaoxishaoji`
   - Description: `辽西烧鸡电商网站`
   - 选择 Public（公开）
   - 勾选 "Add a README file"
5. 点击 "Create repository"

### 1.2 上传项目文件
方式一：使用Git命令（如果你安装了Git）
```bash
git clone https://github.com/你的用户名/liaoxishaoji.git
cd liaoxishaoji
# 复制所有项目文件到这个目录
git add .
git commit -m "初始化项目"
git push origin main
```

方式二：直接在网页上传
1. 进入仓库页面
2. 点击 "Add file" → "Upload files"
3. 拖拽整个项目文件夹上传
4. 点击 "Commit changes"

---

## 第二步：配置GitHub Pages

1. 进入仓库页面
2. 点击 "Settings"（设置）
3. 左侧菜单找到 "Pages"
4. 在 "Source" 部分：
   - 选择 "GitHub Actions"
5. 保存后，GitHub会自动部署
6. 等待几分钟后，你会得到一个地址：
   - `https://你的用户名.github.io/liaoxishaoji`

---

## 第三步：配置Cloudflare

### 3.1 添加站点
1. 打开浏览器，访问 https://dash.cloudflare.com
2. 登录你的Cloudflare账号
3. 点击 "Add a site"（添加站点）
4. 输入域名：`liaoxishaoji.top`
5. 点击 "Add site"
6. 选择 "Free"（免费计划）

### 3.2 更新DNS记录
在DNS管理页面，添加以下记录：

| 类型 | 名称 | 内容 | 代理状态 |
|------|------|------|----------|
| A | @ | 185.199.108.153 | 已代理 |
| A | @ | 185.199.109.153 | 已代理 |
| A | @ | 185.199.110.153 | 已代理 |
| A | @ | 185.199.111.153 | 已代理 |
| CNAME | www | 你的用户名.github.io | 已代理 |

### 3.3 更改域名DNS服务器
1. Cloudflare会给你两个DNS服务器地址，例如：
   - `ns1.cloudflare.com`
   - `ns2.cloudflare.com`
2. 登录你的域名注册商（购买域名的网站）
3. 找到域名管理 → DNS设置
4. 将DNS服务器改为Cloudflare提供的地址
5. 保存更改

---

## 第四步：配置SSL证书

1. 在Cloudflare中，进入 "SSL/TLS"
2. 选择 "Full" 模式
3. 开启 "Always Use HTTPS"
4. 开启 "Automatic HTTPS Rewrites"

---

## 第五步：验证配置

### 5.1 检查DNS解析
在命令行中运行：
```bash
nslookup liaoxishaoji.top
```
应该返回Cloudflare的IP地址

### 5.2 访问网站
- 等待DNS生效（可能需要24-48小时）
- 访问 https://liaoxishaoji.top
- 如果看到你的网站，说明配置成功！

---

## 常见问题

### Q: DNS多久生效？
A: 通常几分钟到几小时，最长可能48小时

### Q: 网站显示404错误？
A: 检查GitHub Pages是否正确部署，确认仓库中有index.php文件

### Q: SSL证书错误？
A: 确保Cloudflare SSL设置为"Full"模式

### Q: 域名无法访问？
A: 检查域名注册商的DNS服务器是否已更改

---

## 需要帮助？

如果遇到问题，可以：
1. 查看GitHub Pages状态：仓库 → Actions
2. 查看Cloudflare状态：Cloudflare → Analytics
3. 使用在线DNS检测工具：https://dnschecker.org