# -*- coding:utf-8 -*-

'''
filename: hackpassword.py
fuction: 根据社工词汇生成密码
by hxer, 2015.12.30

存在的问题：
    genpassword 函数占用内存过多，生成的 password 中有很多重复项， 使用 set 去重， 并不优雅
'''

from __future__ import unicode_literals
from itertools import permutations

def deform(arg):
    '''
    # deform('Admin') -> ('ADMIN','Admin','admin')
    # deform('123')   -> ('123')
    '''
    arg = str(arg).strip()
    # arg is a word
    if arg.isalpha():
        arg = set([arg] + [arg.lower(), arg.upper(), arg.capitalize()])
    else:
        arg = [arg]
    return tuple(arg)    

def genpassword(iterable):
    '''
    '''
    pools = map(deform, iterable)
    result = [[]]
    password = []
    for pool in pools:
        result = [x+[y] for x in result for y in pool]
    for prod in result:
        for r in range(1, len(prod)+1):
            for p in permutations(prod, r):
                password.append(''.join(p))
    return tuple(set(password))
    
