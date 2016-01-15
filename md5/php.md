# php md5 漏洞

## md5() == '0'

* 原理

对字符串 str 满足 md5(str) 为 **0exxx（xxx全为数字,共30位）**, 则 md5(str) == '0' is true
这是php做字符串 == 比较时，进行类类型转换所致

* poc 

'''php
$uasername='240610708';  //md5(username)='0e462097431906509019562988736854'
if (md5($username)=="0"){
	echo "Matchs"."<br/>";
}
'''

