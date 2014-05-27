#! /usr/bin/env python

from __future__ import print_function
from collections import OrderedDict
from collections import namedtuple

import MySQLdb
import glob
import os
import re
import socket
import fcntl
import struct
import sys
import string
import platform

def get_bit():
    bit = {}
    f = open('/proc/cpuinfo')
    for line in f:
        if line.strip():
           if line.rstrip('\n').startswith('flags')\
              or line.rstrip('\n').startswith('Features'):
                 if 'lm' in line.rstrip('\n').split():
                      bit = '64-bit'
                 else:
                      bit = '32-bit'
    return bit


def uptime_stat():
    uptime = {}
    f = open("/proc/uptime")
    con = f.read().split()
    f.close()
    all_sec = float(con[0])
    MINUTE,HOUR,DAY = 60, 3600, 86400
    uptime['day'] = int(all_sec / DAY)
    uptime['hour'] = int((all_sec % DAY) / HOUR)
    uptime['minute'] = int((all_sec % HOUR) / MINUTE)
    uptime['second'] = int(all_sec % MINUTE)
    uptime['Freerate'] = float(con[1]) / float(con[0])
    return uptime


def disk_stat():
    hd = {}
    disk = os.statvfs("/")
    hd['available'] = disk.f_bsize * disk.f_bavail
    hd['capacity'] = disk.f_bsize * disk.f_blocks
    hd['used'] = disk.f_bsize * disk.f_bfree
    return hd


def meminfo():

    meminfo = OrderedDict()

    with open('/proc/meminfo') as f:
        for line in f:
            meminfo[line.split(':')[0]] = line.split(':')[1].strip()
    return meminfo


dev_pattern = ['sd.*', 'mmcblk*']

def size(device):
    nr_sectors = open(device + '/size').read().rstrip('\n')
    sect_size = open(device + '/queue/hw_sector_size').read().rstrip('\n')

    return (float(nr_sectors)*float(sect_size))/(1024.0*1024.0*1024.0)

def detect_devs():
    devs = {}
    for device in glob.glob('/sys/block/*'):
        for pattern in dev_pattern:
            if re.compile(pattern).match(os.path.basename(device)):
               devs['device'] = device
               devs['size'] = size(device)   


def netdevs():

    with open('/proc/net/dev') as f:
        net_dump = f.readlines()

    device_data={}
    data = namedtuple('data',['rx','tx'])
    for line in net_dump[2:]:
        line = line.split(':')
        if line[0].strip() != 'lo':
            device_data[line[0].strip()] = data(float(line[1].split()[0])/(1024.0*1024.0), float(line[1].split()[8])/(1024.0*1024.0))
    return device_data


def cpu_info():
    with open('/proc/cpuinfo') as f:
        for line in f:
                if line.strip():
                        if line.rstrip('\n').startswith('model name'):
                                model_name = line.rstrip('\n').split(':')[1]
                                return model_name


def get_ip_address(ifname):
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    return socket.inet_ntoa(fcntl.ioctl(
        s.fileno(),
        0x8915,
        struct.pack('256s', ifname[:15])
    )[20:24])


def process_list():

    pids = []
    for subdir in os.listdir('/proc'):
        if subdir.isdigit():
            pids.append(subdir)

    return pids


if __name__=='__main__':
   
    Data = {}
    
    Data['bit'] = get_bit()
    Data['uptime'] = uptime_stat()
    Data['hd'] = disk_stat()
    Data['meminfo'] = meminfo()
    Data['devs'] = detect_devs()
    Data['device_data'] = netdevs()
    Data['model_name'] = cpu_info()
    Data['ip'] = get_ip_address('eth0')
    Data['pids'] = process_list()
    hostname = platform.uname()[1]

    Tmemory = Data['meminfo']['MemTotal'][0:len(Data['meminfo']['MemTotal'])-3]
    fmemory = Data['meminfo']['MemFree'][0:len(Data['meminfo']['MemFree'])-3]
    print('Total memory: {0}'.format(float(Tmemory)/1024))
    print('Free memory: {0}'.format(float(fmemory)/1024))
    print('ip: {0}'.format(Data['ip']))
    print('number of pids: {0}'.format(len(Data['ip'])))
    print('cpu: {0}'.format(Data['model_name']))
    print('total disk: {0}'.format(Data['hd']['capacity']/float(1024*1024*1024)))
    print('free disk: {0}'.format(Data['hd']['available']/float(1024*1024*1024)))
    print('OS bits: {0}'.format(Data['bit']))
    print('day: {0}'.format(Data['uptime']['day']))
    print('hour: {0}'.format(Data['uptime']['hour']))
    print('minute: {0}'.format(Data['uptime']['minute']))
    print('second: {0}'.format(Data['uptime']['second']))
    print('cpu freerate: {0}'.format(Data['uptime']['Freerate']))
    print('send_data: {0}'.format(Data['device_data']['eth0'].rx))
    print('receive_data: {0}'.format(Data['device_data']['eth0'].tx))
   
    
    warn = {}
    warn['cpu_load'] = 1.0 - Data['uptime']['Freerate']
    if warn['cpu_load'] > 0.8:
    	warn['is_cpu_overload'] = 1
    else:
    	warn['is_cpu_overload'] = 0
    
    if warn['cpu_load'] < 0.1:
        warn['is_cpu_lowload'] = 1
    else:
        warn['is_cpu_lowload'] = 0
    

    warn['mem_load'] = (float(Tmemory) - float(fmemory)) / float(Tmemory)
    if warn['mem_load'] > 0.8:
        warn['is_mem_overload'] = 1
    else:
        warn['is_mem_overload'] = 0

    if warn['mem_load'] < 0.1:
        warn['is_mem_lowload'] = 1
    else:
        warn['is_mem_lowload'] = 0


    warn['hardware_load'] = (float(Data['hd']['capacity']) - float(Data['hd']['available'])) / float(Data['hd']['capacity'])
    if warn['hardware_load'] > 0.8:
        warn['is_hardware_overload'] = 1
    else:
        warn['is_hardware_overload'] = 0

    if warn['hardware_load'] < 0.1:
        warn['is_hardware_lowload'] = 1
    else:
        warn['is_hardware_lowload'] = 0

    warn['day'] = Data['uptime']['day']
    warn['hour'] = Data['uptime']['hour']
    warn['minute'] = Data['uptime']['minute']


    try: 
      conn=MySQLdb.connect(host='172.5.246.65',
                           user='root',
                           db='bise',
                           passwd='123',
                           port=3306)
    except Exception,e:
      print (e)

    cur=conn.cursor()
    
    try:
      sql='insert into lcn_servers (id, total_mem, free_mem, ip, pro_number, cpu_type, total_disk, free_disk, system_bit, day, hour, minute, second, free_rate, send_data, received_data, hostname) values(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)'
      values=[1, float(Tmemory)/1024, float(fmemory)/1024, Data['ip'], len(Data['ip']), Data['model_name'], Data['hd']['capacity']/float(1024*1024*1024), Data['hd']['available']/float(1024*1024*1024), Data['bit'], Data['uptime']['day'], Data['uptime']['hour'], Data['uptime']['minute'], Data['uptime']['second'], Data['uptime']['Freerate'], Data['device_data']['eth0'].tx, Data['device_data']['eth0'].rx, hostname]
      
      wsql='insert into warning (id, cpu_load, is_cpu_overload, is_cpu_lowload, mem_load, is_mem_overload, is_mem_lowload, hardware_load, is_hardware_overload, is_hardware_lowload, day, hour, minute) values(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)'
      wvalues=[1, warn['cpu_load'], warn['is_cpu_overload'], warn['is_cpu_lowload'], warn['mem_load'], warn['is_mem_overload'], warn['is_mem_lowload'], warn['hardware_load'], warn['is_hardware_overload'], warn['is_hardware_lowload'], warn['day'], warn['hour'], warn['minute']]

      print (wvalues)
     # cur.execute(sql, values)

      cur.execute(wsql, wvalues)
      
      conn.commit()
      cur.close()
      conn.close()
    except MySQLdb.Error,e:
      print (e) 
