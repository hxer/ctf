# -*- coding:utf-8 -*-

import requests
import subprocess


url = "http://202.120.7.202:8888/"
N = 8

session = [None] * N;
rands = [None] * N
hashes = [None] * N

for i in xrange(len(session)):
    session[i] = requests.session()
    p = session[i].get(url+"?go")
    md5 = p.text[len(p.text)-32:]
    r = p.text[:len(p.text)-32]
    rands[i] = r
    hashes[i] = md5
    print i, r, md5


proc = subprocess.Popen(["./a.out"]+rands, stdout=subprocess.PIPE)
for output in iter(proc.stdout.readline,''):
    print output
    i,s = output.split(" ")
    r_output = subprocess.Popen(["php", "check.php", s], stdout=subprocess.PIPE).communicate()[0]
    g_rand,g_hash,g_d,_ = r_output.split("\n")
    print hashes[int(i)], g_hash
    if hashes[int(i)] == g_hash:
        print g_d
        print session[int(i)].get(url+"?"+g_d).text
        proc.kill()
        break
