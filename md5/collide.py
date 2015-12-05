#-*- coding:utf-8 -*-

"""
MD5碰撞
by hxer,2015.12.5
"""

from __future__ import unicode_literals
import hashlib

def formatstr(raw_str):
    """
    """
    tmpstr = map(lambda x:int(x,16), raw_str.split())
    return reduce(lambda x,y: x+y, map(chr, tmpstr))

if __name__ == "__main__":
    """
    [+] str1 and str2, md5 is "008ee33a9d58b51cfeb425b0959121c9"
    """
    #str1和str2,行前d3, af，93 这些字符前都有字符，不是空格
    str1 = '''
      4d c9 68 ff 0e e3 5c 20 95 72 d4 77 7b 72 15 87

    　　d3 6f a7 b2 1b dc 56 b7 4a 3d c0 78 3e 7b 95 18

    　　af bf a2 00 a8 28 4b f3 6e 8e 4b 55 b3 5f 42 75

    　　93 d8 49 67 6d a0 d1 55 5d 83 60 fb 5f 07 fe a2
    '''
    str2='''
      4d c9 68 ff 0e e3 5c 20 95 72 d4 77 7b 72 15 87

    　　d3 6f a7 b2 1b dc 56 b7 4a 3d c0 78 3e 7b 95 18

    　　af bf a2 02 a8 28 4b f3 6e 8e 4b 55 b3 5f 42 75

    　　93 d8 49 67 6d a0 d1 d5 5d 83 60 fb 5f 07 fe a2
    '''

    fmt_str1 = formatstr(str1)
    fmt_str2 = formatstr(str2)
    print(hashlib.md5(fmt_str1).hexdigest())
    print(hashlib.md5(fmt_str2).hexdigest())
