# SMTP扫描

## NC

```bash
nc -nv 11.11.11.103 25
```

## nmap

```bash
nmap smtp.163.com -p 25 --script=smtp-enum-users.nse --script-args=smtp-enum-users.methods={VRFY}

nmap smtp.163.com -p 25 --script=smtp-open-relay.nse
```

