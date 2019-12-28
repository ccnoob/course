# Hacking搜索

- google hacking
- 百度 hacking
- shodan hacking

## 认识搜索引擎

> 搜索引擎不只是搜索页面，搜索是一种hacking行为，搜索引擎也是一种爬虫行为

- 程序
- 文档
- 端口
- 设备

## shodan

- 搜索互联网设备

- Banner:http、ftp、ssh、telnet

- [官网]: https://www.shodan.io

- 常见filter:

  - net(192.168.20.1)
  - city
  - country
  - port
  - os
  - hostname
  - server
  
- 关于H.D.Moore

## Google

- 关键字搜索

  ```bash
  # 筛选
  支付
  +支付 -宝
  +支付 -宝 -商家
  
  # 双引号
  支付 充值
  “支付 充值”
  ```

- intext:把网页中的正文内容中的某个字符做为搜索条件

- intitle: 搜索网页标题中是否有我们所要找的字符

```bash
intitle:电子商务 intext:法人 intext:电话
```

- site:搜索站点
- inurl:搜索我们指定的字符是否存在于URL中

```bash
site:alibaba.com inurl:contact
```

- define: 搜索某个词的定义
- SOX filetype: 搜索制定类型的文件
- linkurl:搜索域名和旁域

```bash
linkurl:cjlu.edu.cn
```

- 搜索案例

```bash
inurl:"level/15/exec/-/show"
inurl:/admin/login
inurl:qq.txt
filetype:xls "username | password"
inurl:ftp filetype:xls
inurl:Service.pwd
```

- [google-hacking-database]: https://www.exploit-db.com/google-hacking-database

## Recon-ng

> 超重量级侦查框架，主要做信息收集

- python开发
- 模块化管理
- 集成api接口
- 数据库化存储查询
- 版本区别(5.0上下)

### 常见问题以及准备

- 代理

  ```bash
  pip3 install pysocks
  ```

- 缺少模块

  ```bash
  marketplace install [modules]
  ```

- 伪装准备，确保安全

  ```bash
  options set user-agent
  ```

- 查询操作

  ```bash
  db query [sql语句]
  ```

### 小案例(爆破dns)

```bash
recon/domains-hosts/hackertarget
recon/domains-hosts/google_site_web
recon/domains-hosts/brute_hosts # 暴力破解
recon/domains-contacts/whois_pocs
```

### 模块分类与举例

- 发现模块

  ```bash
  discovery/info_disclosure/interesting_files
  ```

- 侦查模块

  ```bash
  # 全网爆破自己的用户名是否被注册
  recon/profiles-profiles/profiler
  
  # 网站文件搜索(pdf、xlsx等)，google-hacking技术
  # 需要依赖PyPDF3,用pip安装
  recon/domains-contacts/metacrawler
  
  # 查找某个用户是否存在某些代码库
  recon/profiles-contacts/dev_diver
  ```

- 报告模块

  ```bash
  reporting/csv
  reporting/html
  reporting/json
  reporting/list
  reporting/proxifier
  reporting/pushpin
  reporting/xlsx
  reporting/xml
  ```

- 攻击模块

  ```bash
  exploitation/injection/command_injector
  ```

