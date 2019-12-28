# TCPDUMP命令行抓包

- 默认只抓68个字节

## 抓包

```bash
# 实时显示
tcpdump -i eth0 -s 0

# 保存文件
tcpdump -i eth0 -s 0 -w file.pcap
```

## 读包

```bash
# 普通读包
tcpdump -r file.pacp

# ASC读包
tcpdump -A -r file.pcap

# 十六进制读包
tcpdump -X -r file.pacp
```

## 抓包筛选器

```bash
tcpdump -i eth0 -s 0 tcp port 80
```

## 显示筛选器

```bash
# 利用linux命令筛选
tcpdump -n -r file.pcap | awk '{print $3}' | sort -u

# 利用tcpdump的功能筛选
## 显示源地址
tcpdump -n src host 11.11.11.101 -r file.pacp
## 显示目标地址
tcpdump -n dst host 11.11.11.101 -r file.pacp
## 按端口号
tcpdump -n tcp port 53 -r file.pcap
```

## 高级筛选

```bash
tcpdump	-A	-n	'tcp[13] = 24' -r file.pacp
```

