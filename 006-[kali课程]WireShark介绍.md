# WireShark介绍

Kali网络安全渗透测试工具Top10之一，网络安全从事人员必备技能之一。WireShark具备以下功能和特点:

- 抓包嗅探协议分析
- 安全专家必备的技能
- 抓包引擎
  - Libcap--Linux
  - Winpcap--Windows
- 解码能力

## 筛选器

- 过滤掉干扰的数据包

- 抓包筛选器

- 显示筛选器

  ```mermaid
  graph LR
  A(网卡)-->|过滤|B[抓包筛选器]
  B-->|解码分析|C[抓包引擎]
  C-->|过滤|D[显示筛选器]
  ```


## 常见协议包

- ARP
- ICMP
- TCP
- UDP
- DNS
- HTTP
- FTP

## 数据流

- http
- smtp
- pop3
- ssl

## 信息统计

- 捕获文件属性
- 已解析的地址
- 协议分级
- 会话
- 端点
- 分组长度
- IO图表
- 服务响应时间