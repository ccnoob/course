# Nmap(7.80)详解

## TARGET SPECIFICATION（目标扫描）

```bash
# -iL <inputfilename>: Input from list of hosts/networks
# 指定包含多个主机IP地址的文件
nmap -iL iplist

# -iR <num hosts>: Choose random targets
# 随机选择IP地址，需要输入相应的主机数
nmap -iR 100 -p 22
nmap -iR 100 -p 21,22,23
nmap -iR 100 -p 21,22,23

# --exclude <host1[,host2][,host3],...>: Exclude hosts/networks
# 将IP段中某些IP排除、不进行扫描
nmap 11.11.11.0/24 --exclude 11.11.11.1-100

# --excludefile <exclude_file>: Exclude list from file
# 排除扫描文件中的主机IP
nmap 11.11.11.0/24 --excludefile iplist
```

## HOST DISCOVERY（主机发现）

```bash
# -sL: List Scan - simply list targets to scan
# 特别注意：仅扫描主机，不发送任何包，其他扫描方式在该命令下不会被执行
nmap -sL 11.11.11.102/24

# -sn: Ping Scan - disable port scan
# 不做端口扫描，只进行主机发现
nmap -sn 11.11.11.0/24

# -Pn: Treat all hosts as online -- skip host discovery
# 扫描之前不需要用ping命令，有些防火墙禁止ping命令。可以使用此选项进行扫描
# 注意：有防火墙的时候需要使用
nmap -Pn 11.11.11.0/24 -sn

# -PS/PA/PU/PY[portlist]: TCP SYN/ACK, UDP or SCTP discovery to given ports
# 使用TCP、SYN/ACK、UDP或SCTP去发现端口
nmap -PS 11.11.11.0/24 -sn

# -PE/PP/PM: ICMP echo, timestamp, and netmask request discovery probes
# 使用ICMP响应（echo）、时间戳或子网掩码请求来发现探测
nmap -PE 11.11.11.0/24 -sn

# -PO[protocol list]: IP Protocol Ping
# 使用IP协议的ping
nmap -PO 11.11.11.0/24 -sn

# -n/-R: Never do DNS resolution/Always resolve [default: sometimes]
# 不做DNS解析 或者  总是做DNS反向解析
nmap -n baidu.com -sn

# --dns-servers <serv1[,serv2],...>: Specify custom DNS servers
# 指定自定义的DNS服务器
nmap www.sina.com --dns-servers 8.8.8.8 -sn

# --system-dns: Use OS's DNS resolver
# 使用操作系统的DNS
namp www.sina.com --system-dns -sn

# --traceroute: Trace hop path to each host
# 追踪每台主机的跳转路径
nmap www.sina.com --traceroute
```

## SCAN TECHNIQUES（端口扫描技术）

```bash
#  -sS/sT/sA/sW/sM: TCP SYN/Connect()/ACK/Window/Maimon scans
#  -sU: UDP Scan
#  -sN/sF/sX: TCP Null, FIN, and Xmas scans
#  --scanflags <flags>: Customize TCP scan flags
#  -sI <zombie host[:probeport]>: Idle scan
#  -sY/sZ: SCTP INIT/COOKIE-ECHO scans
#  -sO: IP protocol scan
#  -b <FTP relay host>: FTP bounce scan
```

## PORT SPECIFICATION AND SCAN ORDER（指定端口）

```bash
# -p <port ranges>: Only scan specified ports
Ex: -p22; -p1-65535; -p U:53,111,137,T:21-25,80,139,8080,S:9

# --exclude-ports <port ranges>: Exclude the specified ports from scanning
# 排除指定的端口、不对其进行扫描
namp 11.11.11.102 -p 1-30 --exclude-ports 1-20

#  -F: Fast mode - Scan fewer ports than the default scan
nmap 11.11.11.102 -F

#  -r: Scan ports consecutively - don't randomize
nmap 11.11.11.102 -r

#  --top-ports <number>: Scan <number> most common ports
nmap 11.11.11.102 --top-ports 10

#  --port-ratio <ratio>: Scan ports more common than <ratio>
nmap 11.11.11.102 --port-ratio 0.1
```

## SERVICE/VERSION DETECTION（探测服务）

```bash
#  -sV: Probe open ports to determine service/version info
# 探测开启的端口来获取服务、版本信息
nmap -sV 11.11.11.102

#  --version-intensity <level>: Set from 0 (light) to 9 (try all probes)
# 设置探测服务、版本信息的强度
namp 11.11.11.102 -sV --version-intensity 9

#  --version-light: Limit to most likely probes (intensity 2)
nmap 11.11.11.102 -sV --version-light

#  --version-all: Try every single probe (intensity 9)
nmap 11.11.11.102 -sV --version-all

#  --version-trace: Show detailed version scan activity (for debugging)
# 将扫描的具体过程显示出来
nmap 11.11.11.102 -sV --version-trace
```

## SCRIPT SCAN（脚本扫描）

```bash
#  -sC: equivalent to --script=default
# 等同于--script=default
namp 11.11.11.102 -sC

#  --script=<Lua scripts>: <Lua scripts> is a comma separated list of directories, script-files or script-categories
# 指定使用Lua脚本进行扫描
nmap 11.11.11.102 --script=whois-ip.nse
nmap -sT 11.11.11.102 -p 22 --script=banner.nse

#  --script-args=<n1=v1,[n2=v2,...]>: provide arguments to scripts
# 指定脚本的参数
nmap -v -p 139,445 --script=smb-vuln-*.nse --script-args=unsafe=0 11.11.11.103

#  --script-args-file=filename: provide NSE script args in a file
# 指定提供脚本参数的文件
nmap -v -p 139,445 --script=smb-vuln-*.nse --script-args-file=fileargs 11.11.11.103

#  --script-trace: Show all data sent and received
# 显示全部发送和收到的数据
nmap -sT 11.11.11.102 -p 22 --script=banner.nse --script-trace

#  --script-updatedb: Update the script database.
# 更新脚本的数据库
nmap --script-updatedb

#  --script-help=<Lua scripts>: Show help about scripts.
# 显示脚本的相关信息
# 脚本的目录/usr/share/nmap/script
nmap --script-help=banner.nse
```

## OS DETECTION（操作系统识别）

```bash
#  -O: Enable OS detection
namp -O 11.11.11.102

#  --osscan-limit: Limit OS detection to promising targets
nmap -O 11.11.11.103 --osscan-limit

#  --osscan-guess: Guess OS more aggressively
# 更侵略性地猜测系统
nmap -O 11.11.11.103 --osscan-guess
```

## TIMING AND PERFORMANCE（时间性能）

```bash
#  -T<0-5>: Set timing template (higher is faster)

#  --min-hostgroup/max-hostgroup <size>: Parallel host scan group sizes
# 指定最小、最大的并行主机扫描组大小

#  --min-parallelism/max-parallelism <numprobes>: Probe parallelization
# 指定最小、最大并行探测数量

#  --min-rtt-timeout/max-rtt-timeout/initial-rtt-timeout <time>: Specifies probe round trip time.
# 指定最小、最大的扫描往返时间

#  --max-retries <tries>: Caps number of port scan probe retransmissions.
# 指定最大的重发扫描包的次数

#  --host-timeout <time>: Give up on target after this long
# 指定超时时间

#  --scan-delay/--max-scan-delay <time>: Adjust delay between probes
# 指定每次探测延迟多长时间，即两次探测之间间隔多少时间

#  --min-rate <number>: Send packets no slower than <number> per second
# 最小的发包速率

#  --max-rate <number>: Send packets no faster than <number> per second
# 最大的发包速率
```

## FIREWALL/IDS EVASION AND SPOOFING（防火墙/IDS躲避和欺骗）

```bash
#  -f; --mtu <val>: fragment packets (optionally w/given MTU)
# 设置MTU最大传输单元
nmap -f 1500 11.11.11.103

#  -D <decoy1,decoy2[,ME],...>: Cloak a scan with decoys
# 伪造多个IP地址和源地址一同发送包，从而隐藏在众多的IP地址中而不易被发现
nmap -D 11.11.11.1,11.11.11.102 11.11.11.103

#  -S <IP_Address>: Spoof source address
# 伪造源地址
nmap -S 11.11.11.102 11.11.11.103 -e vboxnet0 -Pn

#  -e <iface>: Use specified interface
# 使用指定的接口
nmap 11.11.11.103 -e vboxnet0

#  -g/--source-port <portnum>: Use given port number
# 使用指定的源端口
nmap -g 10000 11.11.11.103

#  --proxies <url1,[url2],...>: Relay connections through HTTP/SOCKS4 proxies
# 指定代理服务器进行扫描
nmap --proxies 127.0.0.1 11.11.11.103

#  --data <hex string>: Append a custom payload to sent packets
# 在发送包的数据字段中追加自定义的十六进制字符串
nmap -p 22 11.11.11.102 --data FFFFFFFFF

#  --data-string <string>: Append a custom ASCII string to sent packets
# 在发送包的数据字段中追加自定义的ASCII字符串
nmap -p 22 11.11.11.102 --data-string "abc"

#  --data-length <num>: Append random data to sent packets
# 在发送包的数据字段中追加随机的数据
nmap -p 22 11.11.11.102 --data-length 10

#  --ip-options <options>: Send packets with specified ip options
# 使用指定的IP选项发送包
# --ip-options <S|R [route]|L[route]|T|U …>设置IP选项
nmap -p 22 11.11.11.102 --ip-options S 11.11.11.103

#  --ttl <val>: Set IP time-to-live field
# 设置TTL值
nmap 11.11.11.102 --ttl 45

#  --spoof-mac <mac address/prefix/vendor name>: Spoof your MAC address
# 伪造源Mac地址
nmap 11.11.11.102 -p 22 --spoof-mac 00:11:11:11:11:11

#  --badsum: Send packets with a bogus TCP/UDP/SCTP checksum
# 发送伪造TCP/UDP/SCTP校验和Checksum的数据包
nmap 11.11.11.102 --badsum
```

## OUTPUT

```bash
#  -oN/-oX/-oS/-oG <file>: Output scan in normal, XML, s|<rIpt kIddi3,and Grepable format, respectively, to the given filename.
# 分别输出正常、XML、s|<rIpt kIddi3、grepable格式的扫描结果到指定的文件

#  -oA <basename>: Output in the three major formats at once
# 一次性以三种格式输出

#  -v: Increase verbosity level (use -vv or more for greater effect)
# 增加的详细程度（使用VV更详细）

#  -d: Increase debugging level (use -dd or more for greater effect)
# 提高调试水平（使用DD更高）

#  --reason: Display the reason a port is in a particular state
# 显示端口处于特定状态的原因

#  --open: Only show open (or possibly open) ports
# 仅显示打开（或可能打开）端口

#  --packet-trace: Show all packets sent and received
# 显示发送和接收的所有数据包

#  --iflist: Print host interfaces and routes (for debugging)
# 输出主机接口和路由（为了调试）

#  --append-output: Append to rather than clobber specified output files
# 附加到指定的输出文件，而不是乱码

#  --resume <filename>: Resume an aborted scan
# 从指定的文件中恢复终止的扫描

#  --stylesheet <path/URL>: XSL stylesheet to transform XML output to HTML
# 将指定路径的URL的XSL样式表转换为XML输出为HTML格式

#  --webxml: Reference stylesheet from Nmap.Org for more portable XML
# 获取更多便捷的XML参考样式

#  --no-stylesheet: Prevent associating of XSL stylesheet w/XML output
# 防止将XSL样式表的W /XML输出
```

## MISC（杂项）

```bash
#  -6: Enable IPv6 scanning
# 扫描IPv6的地址

#  -A: Enable OS detection, version detection, script scanning, and traceroute
# 一次扫描包含系统探测、版本探测、脚本扫描和跟踪扫描

#  --datadir <dirname>: Specify custom Nmap data file location
# 指定自定义的nmap数据文件位置

#  --send-eth/--send-ip: Send using raw ethernet frames or IP packets
# 使用原始以太网帧或IP数据包发送

#  --privileged: Assume that the user is fully privileged
# 假设用户有全部权限

#  --unprivileged: Assume the user lacks raw socket privileges
# 假设用户缺少原始套接字权限  

#  -V: Print version number
# 输出版本号

#  -h: Print this help summary page.
# 输出帮助信息
```

