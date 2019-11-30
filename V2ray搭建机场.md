# V2ray的搭建机场

V2ray的搭建需要服务端和客户端共同完成，协议基于Vmess

- 官网：https://www.v2ray.com/
- 需要科学上网
- v2ray配置生成器：https://intmainreturn0.com/v2ray-config-gen

## 服务端的搭建

- 需要创建一个国外服务器机场（例如VPS,AWS等）

- 服务端V2ray配置与安装

  ```bash
  #官网一键下载安装
  bash < (curl -L -s https://install.direct/go.sh)
  #编辑配置文件
  vi /etc/v2ray/config.json
  #启动v2ray服务端
  service v2ray start
  ```

- 设置服务端时间

  V2ray的Vmess协议需要时间同步，而国外服务器与国内服务存在时差，无法连通。所以需要设置服务端时间

  ```bash
  #查看当前时间
  date -R
  #设置时间
  cp -rvf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime
  ```

- 设置出站和入站规则（vpc网络）

## 客户端搭建

因为官网的客户端需要科学上网下载，所以改用国内的方式下载

- 下载安装

  ```bash
  #一键下载安装
  git clone https://github.com/ccnoob/v2ray-linux-64
  cd v2ray-linux-64
  bash install
  ```

- 更改配置文件即可科学上网

  ```bash
  #更改配置文件
  vi /etc/v2ray/config
  #重启服务
  service v2ray-10809 restart
  ```

  