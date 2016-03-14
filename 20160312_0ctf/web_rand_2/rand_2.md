# rand_2

从源码来看此题考的是php 随机数的预测，使用的是rand()函数，php rand() 使用的是glibc函数，对于给定的种子将会产生特定不变的随机序列，若能爆破出种子，也就能预测出随机数了。

这里给个示例验证，相同的种子，c和php产生的随机数相同

1. rand.c

```c
#include<stdlib.h>
#include<stdio.h>

int main(){
    srand(1234567890);
    printf("%d",rand());
}
```

```
$ gcc rand.c
$ ./a.out
1727406014
$ php -r "srand(1234567890); echo rand();"
1727406014
```

从结果看，相同的种子，C和php产生的随机数序列将是一样的。

## glibc 产生随机数原理

## poc_1

linux php rand()随机数产生遵循如下表达式:

```
rnd[i] = (rnd[i-3] + rnd[i-31]) % 2^31
```

可以获取前31个随机数，根据这31个随机数就可以预测之后产生的随机数了。