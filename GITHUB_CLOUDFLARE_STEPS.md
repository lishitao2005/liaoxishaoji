# 辽西烧鸡网站发布说明

## 当前已完成
- 项目路径：`D:\liaoxishaoji`
- 已生成 GitHub Pages 静态发布目录：`public/`
- 已生成自定义域名文件：`public/CNAME`，内容为 `liaoxishaoji.top`
- 已生成 GitHub Actions：`.github/workflows/deploy.yml`，会自动发布 `public/`
- 已初始化 Git 仓库并完成首次提交：`发布辽西烧鸡网站`
- 已生成实训报告：`report-liaoxishaoji.docx`

## 为什么要有 public 目录
GitHub Pages 不能运行 PHP，所以 PHP 登录、注册、后台管理等源码保留在项目根目录；真正给别人通过域名访问的是 `public/` 静态展示版。

## GitHub 操作
1. 登录 GitHub：`lishitao2005`。
2. 新建公开仓库：`liaoxishaoji`。
3. 不要勾选 README、.gitignore、License。
4. 在 `D:\liaoxishaoji` 执行：

```bash
git push -u origin main
```

5. 进入 GitHub 仓库 `Settings > Pages`，Source 选择 `GitHub Actions`。
6. 等待 Actions 运行完成。

## Cloudflare 操作
1. 登录 Cloudflare，添加站点：`liaoxishaoji.top`。
2. DNS 添加：

| 类型 | 名称 | 内容 | 代理状态 |
|---|---|---|---|
| A | @ | 185.199.108.153 | 已代理 |
| A | @ | 185.199.109.153 | 已代理 |
| A | @ | 185.199.110.153 | 已代理 |
| A | @ | 185.199.111.153 | 已代理 |
| CNAME | www | lishitao2005.github.io | 已代理 |

3. 到购买域名的平台，把 Nameserver 改成 Cloudflare 给出的两个服务器地址。
4. Cloudflare `SSL/TLS` 选择 `Full`，开启 `Always Use HTTPS`。

## 验证
DNS 生效后访问：

```text
https://liaoxishaoji.top
```
