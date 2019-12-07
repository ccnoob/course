# 熟悉Kali的环境

## 软件管理

> apt与apt-get

```shell
##常规安装
apt update（更新源列表）
apt upgrade(更新需要升级软件)
apt dist-upgrade(升级系统内核)
apt install "软件名称"

##修复
apt update --fix-missing
apt upgrade --fix-broken(卸载不去明确软件以及依赖关系，以apt的稳定为主)

##卸载
apt purge "软件名称"
apt autoremove(自动移除已卸载软件的配置文件)
apt autoclean(自动清理不存在软件包)
```

## Bash常用命令(shell)

### ls

> 列出当前目录里的内容

```shell
##长文件显示
ls -l
```

- linux文件10个重要字符

  - 首字母

    ```shell
    -	文件
    d	目录
    l	链接
    c	字符设备（比如键盘鼠标等）
    b	块设备（比如硬盘设备）
    ```

  - 后9个字符

    ```shell
    前3	"当前用户"
    中3	"所在用户组"
    后3	"其他用户组"
    
    r	"4"
    w	"2"
    x	"1"
    ```

- 常见用法

```shell
##显示所有文件并且以人类可以阅读的方式
ls -alh

##排序
ls -alh --sort=time
ls -alh --sort=size
```

### cd

> 进入目录，和Windows的没有任何区别

```shell
##当前目录
cd .

##进入上一层目录
cd ..
```

### cat

> 查看文件内容

```shell
##查看系统的日志变化
cat /var/log/messages
```

### more(less)

> 分批查看文件内容

```shell
##查看系统的日志变化
more /var/log/messages
```

- 操作

  `Enter`	向下1行

  `Ctrl` + `f` 	向下滚动一屏

  `Space`	向下滚动一屏

  `Ctrl` + `B`	返回上一屏

  `=` 	输出当前的行号

  `:` + `f`	输出文件名和当前行的行号

  `v`	调用Vi编辑器

  `!`	调用shell，并执行命令（Vim中细讲）

  `q`	退出more

### tail(head)

> 默认查看文件最后10行信息

```shell
##每隔2s钟查看系统的变化
watch -n 2 tail -20 /var/log/messages
```

### 增删改查

```shell
##拷贝
cp -rvf 源文件 目标文件

##移动（重命名）
mv -vf 源文件	新文件

##删除
rm -rvf 文件名

##新建目录
mkdir 目录名

##新建文件
vi 文件名
touch 文件名
echo > 文件名
```

### top

> 查看系统任务概览（任务管理器）

```shell
###电子取证时需要细讲
top
```

### ps

> 专门查看进程信息

```shell
###常规用法
ps -ef

###常规用法2
ps aux
```

### ifconfig

> 查看网络配置

### netstat

> 查看网络连接信息

```shell
##查看电脑里已经存在的tcp和udp的连接
netstat -pantu

##尝试登陆一下youku
```

### 管道命令符

> 两个命令间的连接

```shell
|
>
>>
```

### grep(egrep)

> 查找匹配字符串

```shell
##查找含有ssh的匹配行
grep ssh /etc/passwd

##网络地址筛选
netstat -pantu | grep -v "0.0.0.0"
##进一步筛选
netstat -pantu | egrep -v "0.0.0.0|:::"
##筛选列数
netstat -pantu | egrep -v "0.0.0.0|:::" | awk '{print $5}'
##进一步筛选
netstat -pantu | egrep -v "0.0.0.0|:::" | awk '{print $5}' | egrep -v 'and|Address'
##按块区分
netstat -pantu | egrep -v "0.0.0.0|:::" | awk '{print $5}' | egrep -v 'and|Address' | cut -d ":" -f 1
##排序去重
netstat -pantu | egrep -v "0.0.0.0|:::" | awk '{print $5}' | egrep -v 'and|Address' | cut -d ":" -f 1 | sort | uniq
##写入文件
netstat -pantu | egrep -v "0.0.0.0|:::" | awk '{print $5}' | egrep -v 'and|Address' | cut -d ":" -f 1 | sort | uniq > ip
##追加文件
netstat -pantu | egrep -v "0.0.0.0|:::" | awk '{print $5}' | egrep -v 'and|Address' | cut -d ":" -f 1 | sort | uniq >> ip
```

### mount

> 挂载设备与目录

```shell
mount /dev/sda1 /mnt
##挂载虚拟光驱
mount -o loop kali.iso /media/cdrom
```

### dmesg

> 类似于 trail /var/log/message

### find

> 查找文件和目录

```shell
##查找nmap文件
find / -name nmap

##忽略大小写
find / -iname nmap

##通配搜索
find . -name "pr*"

##查找结果并拷贝到新目录
find . -name "pr*" -exec cp -rvf {} /tmp/{} \;
```

### whereis

> 也是查找，速度块，范围小。某些层面类似everything

```shell
##先更新数据库
updatedb
whereis nmap
```

### echo

> 简单而不平凡

### vi(vim)

> 主流神级强大的编辑器