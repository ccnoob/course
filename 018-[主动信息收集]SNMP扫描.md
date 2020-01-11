# SNMP扫描

- 简单网络管理协议(SNMP)

- 工作在UDP 161端口(服务端)

- 主要用于监控目标设备的

  - 操作系统
  - 硬件设备
  - 服务应用
  - 软硬件配置
  - 网络协议状态
  - 设备性能以及资源利用率
  - 设备报错事件
  - 等等等软硬件信息

## snmp
- 信息的金矿
- 经常被错误配置
- public / private / manager

## MIB Tree

- SNMP Managerment Inforemation Base (MIB)
- 树形的网络设备管理功能数据库

## 使用案例

### onesixtyone

```bash
onesixtyone 11.11.11.103 public

onesixtyone -c dict.txt -i hosts -o my.log -w 100
```

### snmpwalk

```bash
# -v指定版本
snmpwalk 11.11.11.103 -c public -v 2c

# 查iso
snmpwalk -c public -v 2c 11.11.11.103 1.3.6.1.2.1.25.4.2.1.2.848
```

### snmp-check

```bash
snmp-check -c public 11.11.11.103

snmp-check -c public 11.11.11.103 -w
```

